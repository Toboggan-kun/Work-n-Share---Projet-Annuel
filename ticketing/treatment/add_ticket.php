<?php

if (isset($_GET['title']) && !empty($_GET['title']) &&
	isset($_GET['author']) && !empty($_GET['author']) &&
	isset($_GET['description']) && !empty($_GET['description']))
{
	$title = $_GET['title'];
	$author = $_GET['author'];
	$description = $_GET['description'];

	// Création du ticket
	$req = $bdd->prepare("	INSERT INTO ticket(title, state, date_start, date_close, author)
							VALUES(?, 0, NOW(), 0, ?)");
	$req->execute(array(	$title, $author));

	// Création de la première description
	$id_ticket = $bdd->lastInsertId();
	$req = $bdd->prepare("	INSERT INTO state_ticket_description(id_ticket, date_post, description, author)
							VALUES(?, NOW(), ?, ?)");
	$req->execute(array($id_ticket, $description, $author));
	$added = 1;
} else {
	echo "ERROR : Formulaire incomplet";
}

?>