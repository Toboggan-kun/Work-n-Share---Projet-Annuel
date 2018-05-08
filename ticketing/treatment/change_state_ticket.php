<?php

if (isset($_GET['state']) && !empty($_GET['state']))
{
	$id_ticket = $_GET['id_ticket'];
	$state = $_GET['state'];

	// Création du ticket
	$req = $bdd->prepare("UPDATE ticket
								SET state = ?
								WHERE id_ticket = ?");
	$req->execute(array(	$state, $id_ticket));
}

header("location:?page=ticket&id_ticket=$id_ticket")

?>