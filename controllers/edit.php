<?php

class editController extends Controller {

 /*function main(){
  // redirect if no action called
  $this->redirect("index.php");
 }*/

 function add(){
  $view=$this->loadView("edit");
  $view->render();
 }

 function edit(){
  $content=$this->loadModel("content");
  $content->load();
  $view=$this->loadView("edit");
  $view->setVariable('content',$content);
  $view->render();
 }

 function save(){
  $content=$this->loadModel("content");
  $content->update();
  $view=$this->loadView("edit_preview");
  $view->setVariable('content',$content);
  $view->render();
 }

}

?>