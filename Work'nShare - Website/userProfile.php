<?php
session_start();
include "header.php";
require "class/dataBaseClass.php";
require "class/windowClass.php";
require "class/formClass.php";
$form = new Form($_POST);

$db = new DataBase();
$db->connectDataBase();


$db->prepareQuery('SELECT * FROM user WHERE idUser = 1'); //A VERIFIER AVEC LE TYPE DE SESSION DE L'UTILISATEUR CONNECTE
$db->executeQuery();
$result = $db->fetchQuery();

?>
<center>

	<h1><i class="fas fa-user-circle"></i>  Mon espace personnel</h2>

	<form id="editProfileForm" method="POST" action="">
		
		<label id="labelEditProfileForm">Nom :</label>
		<label id="labelEditProfileForm">Prénom :</label>
		<label id="labelEditProfileForm">Email :</label>
		<label id="labelEditProfileForm">Mon abonnement actuel :</label>
		<input id="editButton" type="button" value="Editer mon profil" onclick="editProfile()"><br>


	</form>

</center>