<?php


require "class/userClass.php";

$user = new User();
if(isset($_POST['user'])){
	$id = $_POST['user'];
	$user->deleteUser($id);
}
