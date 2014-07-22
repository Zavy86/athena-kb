<?php

/*

     Athena Knowledge Base

        __..._   _...__
   _..-"      `Y`      "-._
   \           |           /
   \\          |          //
   \\\         |         ///
    \\\ _..---.|.---.._ ///
     \\`_..---.Y.---.._`//
      '`               `'

   http://www.athena-kb.org/

*/

session_start();

 // defines
 global $config;
 global $settings;

 // acquire variables
 $module=$_REQUEST['module'];
 $controller=$_REQUEST['controller'];
 $action=$_REQUEST['action'];

 // include configuration
 require("config.inc.php");

 // only for debug
 //ChromePhp::log($_SERVER);

 // check module
 if(!strlen($module)>0){$module=$config['default-module'];}
 //ChromePhp::log("Module to load: ".$module);

 // defines constants
 define('ROOT',realpath(dirname(__FILE__))."/");
 define('HELPERS',ROOT."helpers/");
 define('MODULES',ROOT."modules/");
 define('WIDGETS',ROOT."widgets/");
 define('TEMPLATE',ROOT."templates/".$config['template']."/");
 define('URL',$config['url']);
 define('MODULE',$module);

 // includes system classes
 require(ROOT."system/model.php");
 require(ROOT."system/view.php");
 require(ROOT."system/controller.php");

 // get settings from db
 //$settings="SELECT * FROM core_settings":
 // --- temporary manual settings setup ---
 $settings['fw-title']="PHP-Framework";
 $settings['fw-version']="1.0";

 $settings['navigation']=array(
  array("home",URL),
  array("helloworld",URL."?module=helloworld")
 );

 $settings['sections']['sidebar'][]="quotes";
 $settings['sections']['footer'][]="copyright";
 // ------

 // require controller if exist
 if(file_exists(MODULES.MODULE."/".$controller.".php")){
  //ChromePhp::log("Controller to load: ".MODULE."/".$controller.".php");
  require(MODULES.MODULE."/".$controller.".php");
 }elseif(file_exists(MODULES.MODULE."/controller.php")){
  //ChromePhp::log("Controller to load: ".MODULE."/controller.php");
  require(MODULES.MODULE."/controller.php");
  $controller=MODULE;
 }else{
  // load default controller
  //ChromePhp::log("Controller to load: controller.php");
  $controller=NULL;
 }
 $controller.="Controller";

 // check the action exists
 if(!method_exists($controller,$action)){$action='main';}
 //ChromePhp::log("Action method to call: ".$action."");

 // Create object and call method
 $object=new $controller;
 die(call_user_func(array($object,$action)));
 //die(call_user_func_array(array($object,$action),$_SERVER['REQUEST_URI']));

?>