<?php

class Model{

 // da rifare con la solita classe o con PDO

 private $connection;

 public function __construct(){
  global $config;
  try{
   $connection=new PDO($config['db_type'].":host=".$config['db_host'].";port=".$config['db_port'].";dbname=".$config['db_name'].";charset=utf8",$config['db_user'],$config['db_pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
   $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
   //ChromePhp::log("PDO ".strtoupper($config['db_type'])." connected to ".$config['db_host']);
  }catch(PDOException $e){
   //ChromePhp::warn("PDO ERROR: ".$e->getMessage());
  }
 }

 public function __call($method,$args){
  $args=implode(",",$args);
  $_SESSION['log'][]=array("warn","Method ".$method."(".$args.") was not found in ".get_class($this)." class");
 }

 public function escapeString($string){
  return mysql_real_escape_string($string);
 }

 public function escapeArray($array){
  array_walk_recursive($array,create_function('&$v','$v = mysql_real_escape_string($v);'));
  return $array;
 }

 public function to_bool($val){
  return !!$val;
 }

 public function to_date($val){
  return date('Y-m-d',$val);
 }

 public function to_time($val){
  return date('H:i:s',$val);
 }

 public function to_datetime($val){
  return date('Y-m-d H:i:s',$val);
 }

 public function query($qry){
  $result=mysql_query($qry) or die('MySQL Error: '.mysql_error());
  $resultObjects=array();
  while($row=mysql_fetch_object($result)){
   $resultObjects[]=$row;
  }
  return $resultObjects;
 }

 public function execute($qry){
  $exec=mysql_query($qry) or die('MySQL Error: '.mysql_error());
  return $exec;
 }

}

?>