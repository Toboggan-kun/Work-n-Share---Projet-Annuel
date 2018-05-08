<h1>Matériels</h1>

<table id="table_hardware">
		<tr>
			<td>Désignation</td>
			<td>Type</td>
			<td>Numéro de série</td>
			<td>Date d'achat</td>
			<td>Assignation</td>
		</tr>
		<tr>
<?php

$req = $bdd->query("SELECT * FROM hardware ORDER BY id_hardware");

while ($data = $req->fetch(PDO::FETCH_ASSOC))
{
	$id_hardware = $data["id_hardware"];
	$type = htmlspecialchars($data["type"]);
	$name = $data["name"];
	$serial_number = htmlspecialchars($data["serial_number"]);
	$assignment = htmlspecialchars($data["assignment"]);
	$date_purchase = htmlspecialchars($data["date_purchase"]);
	?>
		<td><?= $name; ?></td>
		<td><?= $type; ?></td>
		<td><?= $serial_number; ?></td>
		<td><?= $date_purchase; ?></td>
		<td><?= $assignment; ?></td>
	<?php
}

?>
	</tr>
</table>