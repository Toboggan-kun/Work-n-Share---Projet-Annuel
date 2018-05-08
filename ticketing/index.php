<?php

$bdd = new PDO('mysql:host=db735400362.db.1and1.com;dbname=db735400362', 'dbo735400362', 'i4w5WN2DMgGbSKC', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

include "donnees.php";
$page = (isset($_GET['page'])) ? $_GET['page'] : "home";

$treatment = "treatment/$page.php";
if (file_exists($treatment))
	include $treatment;

$css = "$page.css";
$page = "pages/$page.php";

$states = array( "En attente de traitement", "En cours de traitement", "En retard", "Terminé" );
$states_color = array( "black", "orange", "red", "green" );

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ticketing</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="css/<?= $css; ?>">
	</head>
	
	<body>
		<ul>
			<li><a href="?page=home">Accueil</a></li>
			<li><a href="?page=create_ticket">Créer un ticket</a></li>
			<li><a href="?page=tickets">Voir les tickets</a></li>
			<li><a href="?page=create_hardware">Ajouter un matériel</a></li>
			<li><a href="?page=hardwares">Voir les matériels</a></li>
		</ul>

		<?php
		if (file_exists($page))
			include $page;
		else
			include "pages/404.php";
		?>
	</body>
</html>