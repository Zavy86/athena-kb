<?php

class helloworldModel extends Model {
 
 private $name;
 
 function getName(){
  return $this->name;
	}
 
 function changeName(){
  $this->name=$_REQUEST['name'];
	}
 
}

?>