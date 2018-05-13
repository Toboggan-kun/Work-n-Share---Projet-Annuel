<?php

require "class/equipmentClass.php";
require "class/windowClass.php";


$window = new Window();
$equipment = new Equipment();
$db = new DataBase();
$query = $equipment->loadEquipments();

$db->prepareQuery('SELECT * FROM openspace ORDER BY idOpenSpace');
$db->executeQuery();
$result = $db->fetchQuery();
//$type = $equipment->loadTypeEquipment();

if(isset($_GET['nameEquipment']) && isset($_GET['typeEquipment']) && isset($_GET['idOpenSpace'])){


	$nameEquipment = $_GET["nameEquipment"];
	$typeEquipment = $_GET["typeEquipment"];
	$idOpenSpace = $_GET['idOpenSpace'];
	$equipment->addEquipment($nameEquipment, $typeEquipment, $idOpenSpace);
}
if(isset($_POST['deleteEquipment'])){
	$idEquipment = $_POST['deleteEquipment'];
	$equipment->deleteEquipment($idEquipment);
}
if(isset($_POST['name_equipment']) && isset($_POST['type_equipment']) && isset($_POST['id_openSpace']) && isset($_POST['id_equipment'])){
	$id = $_POST['id_equipment'];
	$name = $_POST["name_equipment"];
	$type = $_POST["type_equipment"];
	$idos = $_POST['id_openSpace'];
	$equipment->updateEquipment($id, $idos, $type, $name);
}

?>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addEquipmentForm">Ajouter un équipement</button>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#">Rédiger un ticket</button>
<table class="table table-hover">
	<caption>Liste des équipements Work'n Share</caption>

	<thead>
		<tr>
			<th>Numéro de série</th>
			<th>Désignation</th>
			<th>Type</th>
			<th>Statut</th>

			<th>Appartenance</th>
			<th>Assignation</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>

	<?php
		foreach ($query as $value) {
	?>
			<tbody id="roomMaintenance">
			<tr>
	<?php
				echo '<td> #'.$value[0].' </td>';
				echo '<td> '.$value[1].' </td>';
				echo '<td>'.$value[3].'</td>';

				if($value[2] == 1){
					echo '<td> Disponible </td>';
				}else if($value[2] == 2){
					echo '<td> En maintenance </td>';
				}

				if($value[4] == 1){
					echo '<td>Bastille</td>';
				}else if($value[4] == 2){
					echo '<td>République</td>';
				}else if($value[4] == 3){
					echo '<td>Odéon</td>';
				}else if($value[4] == 4){
					echo '<td>Place d\'italie</td>';
				}else if($value[4] == 5){
					echo '<td>Ternes</td>';
				}else if($value[4] == 6){
					echo '<td>Beaubourg</td>';
				}
				echo '<td></td>';
				echo '<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#'.$value[0].$value[2].'">Modifier</button></td>';
				echo '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#'.$value[0].$value[1].'">Supprimer</button></td>';

				echo $window->confirmAction('Etes-vous sûr de vouloir supprimer l\'équipement n°'.$value[0].' '.$value[1].' ?', $value[0].$value[1], 'deleteEquipment('.$value[0].')');
				?>
				<div class="modal fade" id=<?php echo '"'.$value[0].$value[2].'"' ?> role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title">Modifier l'équipement n°<?=$value[0].' '.$value[1]?></h3>
						</div>
						<div class="modal-body">
							<form class="form-group">

								<label>Lieu</label>

								<select id=<?='"selectOpenspace'.$value[0].'"'?>>			
								<?php
								foreach($result as $res){

									echo "<option id='idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
								}
								?>
									

								</select>

								<input id=<?='"nameEquipment'.$value[0].'"'?> type="text" placeholder="Nom de l'équipement" required="required" value=<?='"'.$value[1].'"'?> ></input>
								<label>Type d'équipement</label>

								<select id=<?='"selectEquipmentType'.$value[0].'"'?>>

									<option>Ordinateur</option>
									<option>Ordinateur portable</option>
									<option>Imprimante</option>
									<option>Téléphone</option>
									<option>Machine à canettes</option>
									<option>Machine à café</option>
								</select>

							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							<button type="button" class="btn btn-success" id="nameRoom" data-dismiss="modal" onclick="updateEquipment(<?="'".$value[0]."'"?>)">Confirmer</button>
						</div>
					</div>
					</div>
				<div>

</div>
		<?php
		}
		if($query == null || empty($query)){
			echo '<th colspan=7>Pas d\'équipements enregistrés</th>';
		}
	?>
			</tr>
	</tbody>
</table>
<?php
include "addEquipment.php";

?>

