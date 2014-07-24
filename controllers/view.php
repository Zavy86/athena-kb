<?php

class viewController extends Controller {

 function main(){

  $this->view();
 }

 function index(){
  $contents=$this->loadModel("content");
  $view=$this->loadView("index");
  $view->setVariable('contents',$contents->loadAll());
  $view->render();
 }

 function view(){
  $content=$this->loadModel("content");
  $content->load();
  $view=$this->loadView("view");
  $view->setVariable('content',$content);
  $view->render();
 }

}

?>