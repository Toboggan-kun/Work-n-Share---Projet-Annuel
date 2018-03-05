<?php 
require "conf.inc.php";
require "functions.php";
$db=connectdb();
$query = $db->prepare(" INSERT INTO users (username,password) VALUES (:username,:password)");

$query-> execute (["username"=>$_POST["username"],
					"password"=> $_POST["password"]	
					]);