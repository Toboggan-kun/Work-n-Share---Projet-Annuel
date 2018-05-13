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


	<h1><i class="fas fa-user-circle"></i>  Mon espace personnel</h2>
	<div id="contentInfo">
		<h3>Mes informations personnelles</h3>
		
		<form id="editProfileForm" method="POST" action="">
			<span id="editProfileFormSpan">
				<!-- AJOUTER PLUS TARD LES INFORMATIONS DE L'USER -->
				<span class="userInfo">Nom</span><span id="inputInfo1"><p id="labelInfo1">Exemple de nom</p></span>
				<span class="userInfo">Prénom</span><span id="inputInfo2"><p id="labelInfo2"> Exemple de prénom</p></span>
				<span class="userInfo">Email</span><span id="inputInfo3"><p id="labelInfo3">mail@mail.fr</p></span>
				<span class="userInfo">Téléphone</span><span id="inputInfo4"><p id="labelInfo4">0101010101</p></span>
				
			</span>
			<span id="buttonContainer">
				<input id="undoButton" type="button" value="Annuler" onclick="undo()">	
				<input id="editButton" type="button" value="Editer mon profil" onclick="editProfile()"><br>
			</span>
			


		</form>
		
	</div>
	<div id="contentInfo">
		<h3>Mon abonnement</h3>

		<input id="editButton" type="button" value="Changer d'abonnement" ><br>
	</div>
	<div id="contentInfo">
		<h3>Mes réservations</h3>

		<input id="editButton" type="button" value="Faire une réservation" ><br>

	</div>
	<div id="contentInfo">
		<h3>Supprimer mon compte</h3>

		

	</div>

</center>

<?php

include "footer.php";

?>