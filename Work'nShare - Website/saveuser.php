<?php 
require "conf.inc.php";
require "form.php";
require "functions.php";
$form = new Form($_POST);

$db=connectdb();
$query = $db->prepare(" INSERT INTO user (nameUser, surnameUser, emailUser, passwordUser, subscription) VALUES (:nameUser, :surnameUser, :emailUser, :passwordUser)");

$query-> execute([
					"nameUser" => $_POST["nameUser"],
					"surnameUser" => $_POST["surnameUser"],
					"emailUser"=> $_POST["emailUser"],
					"passwordUser" => $_POST["passwordUser"]
				]);

$query = $db->prepare("UPDATE user SET subscription = 0 WHERE emailUser = :emailUser");
$query -> execute(["emailUser" => $_POST["emailUser"]]);
