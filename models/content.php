<?php

class contentModel extends Model {

 private $id;
 private $title;
 private $content;

 public function __get($name){
  if(property_exists($this,$name)){
   return $this->$name;
  }
 }

 function load($id=NULL){

  if($id==NULL){
   if($_GET['idContent']>0){
    $id=$_GET['idContent'];
   }elseif($_GET['content']=="random"){
    $id=rand(1,10);
   }
  }

  $this->id=$id;
  $this->title="title $id from db";
  $this->content="content $id from db";
 }

 function update(){
  $this->id=$_POST['id'];
  $this->title=$_POST['title'];
  $this->content=$_POST['content'];
 }

}

?>