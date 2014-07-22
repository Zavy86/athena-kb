<?php

class View{
 
 private $buffer;
 private $template;
 private $view;
 private $sections=array();
 private $variables=array();

 public function __construct($view,$template){
  // check if template exist
  if(!file_exists(TEMPLATE.$template.".php")){
   //ChromePhp::warn("Template '".TEMPLATE.$template.".php' not found, load default template");
   $template="default";
  }
  //ChromePhp::log("Template to load: ".$template);
  $this->template=TEMPLATE.$template.".php";
  // check if view exist
  if(file_exists(MODULES.MODULE."/views/".$view.".php")){
   //ChromePhp::log("View to load: ".MODULES.MODULE."/views/".$view.".php");
   $this->view=MODULES.MODULE."/views/".$view.".php";
  }elseif(file_exists(TEMPLATE.$view.".php")){
   //ChromePhp::log("View to load: ".TEMPLATE.$view.".php");
   $this->view=TEMPLATE.$view.".php";
  }else{
   //ChromePhp::warn("View '".MODULES.MODULE."/views/".$view.".php' not found");
   $this->view=TEMPLATE."not-found.php";
  }
  
  // --- load sections ---
  global $settings;
  $this->sections=$settings['sections'];
  
 }

 public function setSection($section,$val){
  $this->sections[$section]=$val;
 }
 
 public function setVariable($variable,$val){
  $this->variables[$variable]=$val;
 }
 
 function parseFile($file_path){
  //
  extract($this->variables);
  //
  ob_start();
  include($file_path);
  $buffer=ob_get_contents();
  ob_end_clean();
  return $buffer;
 }

 function loadWidget($file_path){
  $widget=NULL;
  if(file_exists($file_path)){
   $widget.="<div id=\"widget\">\n";
   $widget.=$this->parseFile($file_path);
   $widget.="</div>\n";
  }
  return $widget;
 }
 
 function parseSections($sections=array()){
  //
  if(count($sections)>0){
   foreach($sections as $section=>$data){
    $content=NULL;
    // convert into an array if isn't
    if(!is_array($data)){
     $tmp=$data;
     $data=array();
     $data[]=$tmp;
    }
    // 
    foreach($data as $item){
     if(file_exists(WIDGETS.$item.".php")){
      $content.=$this->parseFile(WIDGETS.$item.".php");
     }else{
      $content.=$item;
     }
    }
    if($content<>NULL){
     $content="<div id=\"".$section."\">\n".$content."\n</div>\n";
    }
    $this->buffer=str_replace("<!--[section=".$section."]-->",$content,$this->buffer);
   }
  }
 }
 
 public function render(){
  //
  global $settings;
  extract($settings);
  //
  extract($this->variables);
  //
  ob_start();
  include($this->template);
  $this->buffer=ob_get_contents();
  ob_end_clean();
  //
  $content="<div id=\"content\">\n".$this->parseFile($this->view)."\n</div>\n";
  $this->buffer=str_replace("<!--[section=content]-->",$content,$this->buffer);
  
  //
  $navigation="<ul>\n";
  foreach($settings['navigation'] as $navigation_item){
   $navigation.="<li><a href=".$navigation_item[1].">".$navigation_item[0]."</a></li>\n";
  }
  $navigation.="</ul>\n";
  
  $this->sections['navigation']=$navigation;
  
  // 
  $this->parseSections($this->sections);
  // show rendered template
  echo $this->buffer;
 }
 
}

?>