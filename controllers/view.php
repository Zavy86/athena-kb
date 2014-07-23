<?php

class viewController extends Controller {

 function main(){
  $content=$this->loadModel("content");

  $content->load($_REQUEST['idContent']);

  $view=$this->loadView("view");
  $view->setVariable('content',$content);
  $view->render();
 }

}

?>