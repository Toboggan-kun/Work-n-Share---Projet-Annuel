<?php

require "class/eventClass.php";
require "class/windowClass.php";

$window = new Window();
$event = new Event();
$db = new DataBase();


if(isset($_POST['deleteEvent'])){
	$id = $_POST['deleteEvent'];
	$event->deleteEvent($id);
}


$db->prepareQuery('SELECT * FROM event ORDER BY idEvent DESC');
$db->executeQuery();
$result = $db->fetchQuery();
?>

<table class="table table-hover">
	<h3>Liste des évènements Work'n Share</h3>
	<thead>
		<tr>
			<th>ID</th>
			<th>Titre</th>
			<th>Date de création</th>
			<th>Date prévue</th>

			<th>Auteur</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<?php

		foreach ($result as $value) {

	?>
	<tbody>
		<tr>
			<?php

				echo '<th> '.$value[0].' </th>';
				echo '<th> '.$value[1].' </th>';
				$value[2] = date("d-m-Y", strtotime($value[2]));
				$value[3] = date("d-m-Y", strtotime($value[3]));
				echo '<th> '.$value[2].' </th>';
				echo '<th> '.$value[3].' </th>';
				echo '<th>Non défini</th>';
				echo '<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#consultEvent'.$value[0].'">Consulter</button></td>';
				echo '<td><button type="button" class="btn btn-warning">Modifier</button></td>';
				echo '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#'.$value[0].'">Supprimer</button></td>';
				
				echo $window->confirmAction("Etes-vous sûr de vouloir supprimer l'évènement n°".$value[0]." ?", $value[0], 'deleteEvent('.$value[0].')');


				
			}
			?>
		</tr>
	</tbody>
</table>
