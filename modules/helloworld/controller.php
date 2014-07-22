<?php

class helloworldController extends Controller {
	
	function main(){
  $page=new stdClass();
  $page->title="Hello World";
  $page->content="<p>Welcome to PHP-Framework</p>";
  $view=$this->loadView("helloworld");
  $view->setVariable('page',$page);
  $view->render();
	}
 
 function changeName(){
  $page=new stdClass();
  $model=$this->loadModel();
  $model->changeName();
  $name=$model->getName();
  $page->title="Hello ".$name;
  $page->content="<p>Welcome to PHP-Framework</p>";
  $view=$this->loadView("helloname");
  $view->setVariable('page',$page);
  $view->setVariable('name',$name);
  $view->render();
	} 
 
}

?>