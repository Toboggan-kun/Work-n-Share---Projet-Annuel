<?php

$id_ticket = $_GET['id_ticket'];

$req = $bdd->prepare("SELECT * FROM ticket WHERE id_ticket = ?");
$req->execute(array($id_ticket));

$data = $req->fetch(PDO::FETCH_ASSOC);

if ($data == false)
{
	?>
	<h1>CE TICKET N'EXISTE PAS !</h1>
	<?php
	die();
}

$title = htmlspecialchars($data["title"]);
$date_start = $data["date_start"];
$author = htmlspecialchars($data["author"]);

?>
<h1>Ticket N° <?= $id_ticket; ?></h1>
<p>Créé par <b><?= $author ?></b> le <b><?= $date_start; ?></b></p>

<h2>Traitement</h2>
<?php

$req = $bdd->prepare("SELECT * FROM state_ticket_description WHERE id_ticket = ? ORDER BY date_post");
$req->execute(array($id_ticket));

while ($data = $req->fetch(PDO::FETCH_ASSOC))
{
	$date_post = $data["date_post"];
	$author = htmlspecialchars($data["author"]);
	$message = htmlspecialchars($data["description"]);
	?>
	<div>
		<p>Par <b><?= $author ?></b> le <b><?= $date_start; ?></b></p>

		<p>Message<br>
		<?= $message; ?>
		</p>
	</div>
	<br>
	<?php
}

?>

<h1>Répondre</h1>
<form>
	<input type="hidden" name="page" value="add_answer">
	<input type="hidden" name="id_ticket" value="<?= $id_ticket; ?>">
	<p>
		<label for="author">Par : </label>
		<input type="text" name ="author" id="author">
	</p>

	<p>
		<label for="description">Message</label><br>
		<textarea name="description" id="description" cols="30" rows="10"></textarea>
	</p>

	<p>
		<button>Répondre</button>
	</p>
</form>