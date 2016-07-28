<?php

$title = "DNC Admin";
$sub_title = "Welcome to the Do-Not-Call List";

/* $local_net = "192.168.1.200"; */

//mysql database connection settings
$dbhost = "localhost";
$dbpass = "password";
$dbuser = "dnc";
$dbname = "dncdb";

 $dbconnection = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Database connection failed");

mysql_select_db($dbname) or die("data base open failed");

if(isset($_POST['submit'])){
	$INdefault = $_POST['sipID'];
	setcookie("asteridex[sipID]",$INdefault,time()+99999999);
  } else {
  if(isset($_COOKIE['asteridex'])){
	$INdefault = $_COOKIE['asteridex']['sipID'];
  } else {
	//$INdefault = "local/222@from-internal" ;
	$INdefault = $defaultExt ;
	setcookie("asteridex[sipID]",$INdefault,time()+99999999);
  }
}
?>
