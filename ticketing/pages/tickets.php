<h1>Tickets</h1>

<ul>
	<li><a href="?page=tickets&sort_by=all">Tous</a></li>
	<li><a href="?page=tickets&sort_by=waiting">En attente</a></li>
	<li><a href="?page=tickets&sort_by=in_progress">En cours</a></li>
	<li><a href="?page=tickets&sort_by=late">En retard</a></li>
	<li><a href="?page=tickets&sort_by=finished">Terminé</a></li>
</ul>

<?php

$sort_by = (isset($_GET["sort_by"])) ? $_GET["sort_by"] : "all";

switch ($sort_by) {
	case "waiting":
		$sql = "SELECT * FROM ticket WHERE state = 0 ORDER BY id_ticket";
		break;

	case "in_progress":
		$sql = "SELECT * FROM ticket WHERE state = 1 ORDER BY id_ticket";
		break;
	
	case "late":
		$sql = "SELECT * FROM ticket WHERE state = 2 ORDER BY id_ticket";
		break;
	
	case "finished":
		$sql = "SELECT * FROM ticket WHERE state = 3 ORDER BY id_ticket";
		break;

	default:
		$sql = "SELECT * FROM ticket ORDER BY id_ticket";
}

$req = $bdd->query($sql);

while ($data = $req->fetch(PDO::FETCH_ASSOC))
{
	$id_ticket = $data["id_ticket"];
	$title = htmlspecialchars($data["title"]);
	$date_start = $data["date_start"];
	$author = htmlspecialchars($data["author"]);
	$state = htmlspecialchars($data["state"]);
	?>
	<div>
		<h1><?= $title; ?></h1>
		<p>Ticket N° <?= $id_ticket; ?>, créé le <b><?= $date_start; ?></b> par <b><?= $author ?></b>, Status : <b style="color: <?= $states_color[$state]; ?> "><?= $states[$state]; ?></b></p>
		<a href="?page=ticket&id_ticket=<?= $id_ticket; ?>">Voir le ticket</a>
		<hr>
	</div>
	<?php
}

?>