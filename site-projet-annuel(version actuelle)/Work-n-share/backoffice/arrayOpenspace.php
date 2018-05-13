<?php
session_start();
require "class/openspaceClass.php";

$db = new DataBase();
$openSpace = new OpenSpace();

$result = $openSpace->loadOpenspaces();


if( //A CORRIGER
	isset($_POST['open']) &&
	isset($_POST['close']) &&
	isset($_POST['id']) &&
	isset($_POST['day'])

){


	$openHour = $_POST['open'];
	$closeHour = $_POST['close'];
	$id = $_POST['id'];
	$day = $_POST['day'];

	$newSchedule = new OpenSpace();
	$newSchedule->updateSchedules($openHour, $closeHour, $day, $id);


}

$db->prepareQuery("SELECT idOpenSpace, nameOpenSpace FROM openspace WHERE idOpenSpace = ".$result[0]['idOpenSpace']."");
$db->executeQuery();
$nameOpenSpace = $db->fetchQuery();


?>
<button type="button" class="btn btn-info btn-lg" >Annoncer une fermeture</button>
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Lieu</th>
				<th>Etat</th>
				<th>Lundi</th>
				<th>Mardi</th>
				<th>Mercredi</th>
				<th>Jeudi</th>
				<th>Vendredi</th>
				<th>Samedi</th>
				<th>Dimanche</th>
				<th>Modifier les plages horaires</th>
			</tr>
		</thead>
		<?php
			foreach ($result as $res) {

				$loadAllSchedules = $openSpace->loadSchedulesById($res[0]);
		?>
		<tbody>
			<tr>
				<?php
					//LIEU
					echo '<td >'.utf8_encode($res[1]).'</td>';
				?>
				
				<td>Ouverture</td>
				<?php
					foreach ($loadAllSchedules as $value) {
						//OUVERTURES
						$value[1] = strtotime($value[1]);
						echo '<td>'.date("H:i", $value[1]).'</td>';


					}
					echo '<td rowspan="2"><button type="button" data-toggle="modal" class="btn btn-warning" data-target="#'.$res[0].$res[1].'" >Modifier</button></td>';


				?>

			</tr>
			<tr>
				<td></td>
				<td>Fermeture</td>

				<?php
				//FERMETURES
					foreach ($loadAllSchedules as $value) {
						$value[2] = strtotime($value[2]);
						echo '<td>'.date("H:i", $value[2]).'</td>';
					}

				?>
			</tr>
		</tbody>
		<div class="modal fade" id=<?=$res[0].$res[1]?> role="dialog">
			<div class="modal-dialog modal-lg">


				<div class="modal-content">
					<!-- CHARGE LES MESSAGES D'ERREURS -->
					<div class="modal-header">
						<h2 class="modal-title">Modifier les plages horaire de <?=$res[1]?></h2>
					</div>
					<div class="modal-body">
						<div class="panel panel-default">
							<form class="form-horizontal" onchange="isChecked(this)">
								
								<?php
								foreach ($loadAllSchedules as $value) {
									//JOURS DE LA SEMAINE
									if($value[0] == 1){
										echo '<div class="panel-heading">Lundi </div>';
									}else if($value[0] == 2){
										echo '<div class="panel-heading">Mardi</div>';
									}else if($value[0] == 3){
										echo '<div class="panel-heading">Mercredi</div>';
									}else if($value[0] == 4){
										echo '<div class="panel-heading">Jeudi</div>';
									}else if($value[0] == 5){
										echo '<div class="panel-heading">Vendredi</div>';
									}else if($value[0] == 6){
										echo '<div class="panel-heading">Samedi</div>';
									}else if($value[0] == 7){
										echo '<div class="panel-heading">Dimanche</div>';
									}
									echo '<div class="panel-body">';
										$value[1] = strtotime($value[1]); //HEURE D'OUVERTURE
										$value[2] = strtotime($value[2]); //HEURE DE FERMETURE
										echo '<p>Ouverture prévue <input class="form-control" id="openHour" type="time"  value="'.date("H:i", $value[1]).'"></p>';
										echo '<p>Fermeture prévue <input class="form-control" id="closeHour" type="time" value="'.date("H:i", $value[2]).'"></p>';
										/*$currentDate = date("Y-m-d");
										echo '<p>Fermer l\'openspace ce jour<input type="checkbox"  name="checkbox" ></p>';
										echo '<p>Veuillez préciser la/les date(s) de fermeture <input type="date" min="'.$currentDate.'"" step="monday"></p>';
										echo '<p>Veuillez indiquer le motif de la fermeture</p>
									    	<select>
									    		<option></option>
									    		<option>Jour férié</option>
									    		<option>Clôture annuelle des comptes</option>
									    		<option>Travaux</option>
									    		<option>Fermeture exeptionnelle</option>

									    	</select>';
										echo '<input id="checkBoxCloseOpenspace" type="button" name="'.$nameOpenSpace[0]['idOpenSpace'].'" value="Modifier" onclick="updateSchedules('.$nameOpenSpace[0]['idOpenSpace'].', '.$value[0].')">';*/
									echo '</div>'; //FIN DU PANEL BODY
									echo '<button type="button" class="btn btn-success" onclick="updateSchedules('.$nameOpenSpace[0]['idOpenSpace'].','.$value[0].')">Modifier</button>';
								}//FIN DU FOREACH
									?>
							</form>
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				</div>

						

				</div>
			</div>
		</div>
		<?php
			} //FIN DU FOREACH
		?>
	</table>
</div>
