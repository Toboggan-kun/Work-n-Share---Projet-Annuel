<?php
session_start();
include "header.php";
require "class/dataBaseClass.php";
require "class/windowClass.php";

$db = new DataBase();
$db->connectDataBase();


$db->prepareQuery('SELECT * FROM user WHERE idUser = 1'); //A VERIFIER AVEC LE TYPE DE SESSION DE L'UTILISATEUR CONNECTE
$db->executeQuery();
$result = $db->fetchQuery();

?>
<center>

	<h1><i class="fas fa-user-circle"></i>  Mon espace personnel</h2>

	<form id="editProfileForm">
		
		<label id="labelEditProfileForm">Nom </label><br>
		<label id="labelEditProfileForm">Prénom </label><br>
		<label id="labelEditProfileForm">Email </label><br>
		<label id="labelEditProfileForm">Mon abonnement actuel </label><br>
		<button onclick="editProfile()">Editer mon profil</button><br>
	</form>

</center>