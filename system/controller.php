<?php

class Controller{

 public function main(){
		$view=$this->loadView();
  $view->render();
 }

 public function loadModel(){
  require(MODULES.MODULE."/model.php");
  $model=MODULE."Model";
  $return=new $model;
  return $return;
 }

 public function loadView($name="main",$template="default"){
  $view=new View($name,$template);
  return $view;
 }

 public function redirect($location){
  header("Location: ".URL.$location);
 }
 
}

?>