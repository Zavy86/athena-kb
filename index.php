<?php

/*

     Athena Knowledge Base

        __..._   _.-.__
   _..-"      `Y` | |  "-._
   \           |  | |      /
   \\          |  | |     //
   \\\         |   V     ///
    \\\ _..---.|.---.._ ///
     \\`_..---.Y.---.._`//
      '`               `'

   http://www.athena-kb.org/

*/

 session_start();

 // if not redirected reset log session array
 if($_SESSION['redirect']<>TRUE){$_SESSION['log']=array();}else{$_SESSION['redirect']=FALSE;}
 $_SESSION['log'][]=array("log","Logs from: ?".$_SERVER['QUERY_STRING']);

 // defines
 global $config;
 global $settings;

 $_SESSION['debug']=TRUE;
 //$_SESSION['debug']=FALSE;

 // acquire variables
 $controller=$_REQUEST['controller'];
 $action=$_REQUEST['action'];

 // include configuration
 require("config.inc.php");

 // defines constants
 define('URL',$config['url']);
 define('ROOT',realpath(dirname(__FILE__))."/");
 define('HELPERS',ROOT."helpers/");
 define('SYSTEM',ROOT."system/");
 define('MODELS',ROOT."models/");
 define('VIEWS',ROOT."views/");
 define('CONTROLLERS',ROOT."controllers/");
 define('LANGUAGES',ROOT."languages/");
 define('TEMPLATE',"template/");

 // includes system classes
 require(SYSTEM."model.php");
 require(SYSTEM."view.php");
 require(SYSTEM."controller.php");

 // get settings from db
 //$settings="SELECT * FROM core_settings":
 // --- temporary manual settings setup ---
 $settings=new stdClass();
 $settings->title="Athena Knowledge Base";
 $settings->version="1.0.0";

 /*$settings['navigation']=array(
  array("home",URL),
  array("random",URL."?controller=view&content=random"),
  array("create",URL."?controller=edit&action=add")
 );

 $settings['sections']['sidebar'][]="logo";
 $settings['sections']['sidebar'][]="navigation";
 //$settings['sections']['sidebar'][]="quotes";
 $settings['sections']['footer'][]="copyright";
 // ------*/

 // load language file
 $language=$_SESSION['language'];
 if(file_exists(LANGUAGES.$language.".xml")){
  // load selected locale file
  $xml=simplexml_load_file(LANGUAGES.$language.".xml");
 }elseif(file_exists(LANGUAGES."default.xml")){
  // load deafult locale file
  $xml=simplexml_load_file(LANGUAGES."default.xml");
 }
 if($xml<>NULL){
  $GLOBALS['locale']=array();
  foreach($xml->text as $text_xml){
   $key="{".(string)$text_xml['key']."}";
   $GLOBALS['locale'][$key]=(string)$text_xml;
  }
 }

 // require controller if exist
 if(file_exists(CONTROLLERS."/".$controller.".php")){
  $_SESSION['log'][]=array("log","Controller to load: ".CONTROLLERS.$controller.".php");
  require(CONTROLLERS."/".$controller.".php");
  define('CONTROLLER',$controller);
  $controller_class=$controller."Controller";
 }else{
  if($controller<>NULL){
   $_SESSION['log'][]=array("error","Controller to load: ".CONTROLLERS.$controller.".php was not found");
  }
  $_SESSION['log'][]=array("log","Controller to load: ".CONTROLLERS."controller.php");
  define('CONTROLLER',"controller");
  $controller_class="Controller";
 }


 // check the action exists
 if(method_exists($controller_class,$action)){
  $_SESSION['log'][]=array("log","Action method to call: ".$action);
  define('ACTION',$action);
 }else{
  if($action<>null){$_SESSION['log'][]=array("warn","Method ".$action."() was not found in ".$controller_class." class");}
  $_SESSION['log'][]=array("log","Action method to call: main");
  define('ACTION',"main");
  $action="main";
 }

 // Create object and call method
 $object=new $controller_class;
 die(call_user_func(array($object,$action)));
 //die(call_user_func_array(array($object,$action),$_SERVER['REQUEST_URI']));

?>