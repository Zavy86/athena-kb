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
    $id=rand(1,$this->count("contents"));
   }
  }

  $content=$this->queryUniqueObject("SELECT * FROM `contents` WHERE `id`='".$id."'");

  $this->id=$content->id;
  $this->title=$content->title;
  $this->content=$content->content;
 }

 function loadAll(){
  $contents=$this->queryObjects("SELECT * FROM `contents` ORDER BY `title` ASC");
  return $contents;
 }

 function update(){
  $content=new stdClass();
  $content->id=$_POST['id'];
  $content->title=$_POST['title'];
  $content->content=$_POST['content'];
  if($content->id>0){
   return $this->queryUpdate("contents",$content);
  }else{
   return $this->queryInsert("contents",$content);
  }
 }

 function delete(){
  $idContent=$_GET['idContent'];
  return $this->queryDelete("contents",$idContent);
 }

}

?>