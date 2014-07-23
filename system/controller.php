<?php

class Controller{

 public function main(){
  $view=$this->loadView();
  $view->render();
 }

 public function redirect($location){
  header("Location: ".URL.$location);
 }

 public function loadModel($model=NULL){
  // require model if exist
  if(file_exists(MODELS.$model.".php")){
   $_SESSION['log'][]=array("log","Model to load: ".MODELS.$model.".php");
   require_once(MODELS.$model.".php");
   $model=$model."Model";
   $return=new $model;
  }else{
   $_SESSION['log'][]=array("error","Model to load: ".MODELS.$model.".php was not found");
   $return=FALSE;
  }

  return $return;
 }

 public function loadView($name="main",$template="default"){
  $view=new View($name,$template);
  return $view;
 }

}

?>