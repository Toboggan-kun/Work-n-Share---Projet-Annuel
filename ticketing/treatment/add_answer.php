<?php

if (isset($_GET['id_ticket']) && !empty($_GET['id_ticket']) &&
	isset($_GET['author']) && !empty($_GET['author']) &&
	isset($_GET['description']) && !empty($_GET['description']))
{
	$id_ticket = $_GET['id_ticket'];
	$author = $_GET['author'];
	$description = $_GET['description'];

	// Ajout de la réponse
	$req = $bdd->prepare("	INSERT INTO state_ticket_description(id_ticket, date_post, description, author)
							VALUES(?, NOW(), ?, ?)");
	$req->execute(array($id_ticket, $description, $author));
	$added = 1;
} else {
	echo "ERROR : Formulaire incomplet";
}

?>