<?php

class View{

 private $buffer;
 private $template;
 private $view;
 private $sections=array();
 private $variables=array();

 public function __construct($view,$template){
  // check if template exist
  if(file_exists(ROOT.TEMPLATE.$template.".php")){
   $_SESSION['log'][]=array("log","Template to load: ".$template);
  }else{
   $_SESSION['log'][]=array("warn","Template to load:'".ROOT.TEMPLATE.$template.".php' not found, load default template");
   $template="default";
  }
  $this->template=ROOT.TEMPLATE.$template.".php";
  // check if view exist
  if(file_exists(VIEWS.$view.".php")){
   $_SESSION['log'][]=array("log","View to load: ".VIEWS.$view.".php");
   $this->view=VIEWS.$view.".php";
  }else{
   $_SESSION['log'][]=array("error","View to load: ".VIEWS.$view.".php not found, load default view");
   $this->view=VIEWS."not-found.php";
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

 /*function parseFile($file_path){
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
 }*/

 public function render(){
  // gloabl variables
  //global $config;
  global $settings;
  extract($settings);

  //
  extract($this->variables);
  //
  ob_start();
  //include($this->template);
  include(ROOT.TEMPLATE."headers.php");

  // show debug logs
  if($_SESSION['debug']){
   echo "<div id='debug'>\n <pre>\n";
   foreach($_SESSION['log'] as $log){echo "<code class='".$log[0]."'>".$log[1]."</code>\n";}
   echo "  </pre>\n</div>\n";
  }

  include($this->view);
  include(ROOT.TEMPLATE."footer.php");
  $this->buffer=ob_get_contents();
  ob_end_clean();

  //
  $this->buffer=str_replace(array_keys($GLOBALS['locale']),array_values($GLOBALS['locale']),$this->buffer);


  //
  //$content="<div id=\"content\">\n".$this->parseFile($this->view)."\n</div>\n";
  //$this->buffer=str_replace("<!--[section=content]-->",$content,$this->buffer);

  //
  //$navigation="<ul>\n";
  //foreach($settings['navigation'] as $navigation_item){
   //$navigation.="<li><a href=".$navigation_item[1].">".$navigation_item[0]."</a></li>\n";
  //}
  //$navigation.="</ul>\n";

  //$this->sections['navigation']=$navigation;

  //
  //$this->parseSections($this->sections);

  // show rendered template
  echo $this->buffer;
 }

}

?>