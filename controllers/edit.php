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

  /*$content->update();
  $view=$this->loadView("edit");
  $view->setVariable('content',$content);
  $view->render();*/

  $id=$content->update();

  if($id!==FALSE){$this->redirect("?controller=view&idContent=".$id);}
  else{echo "update error";}
 }

 function delete(){
  $content=$this->loadModel("content");
  if($content->delete()!==FALSE){$this->redirect("?controller=view&action=index");}
  else{echo "delete error";}
 }

}

?>