<?php

require "class/roomClass.php";
require "class/windowClass.php";


$room = new Room();
$window = new Window();

$result = $room->displayOpenspaces();
$typeRoom = $room->displayTypeRoom();


if(isset($_POST['idOpenSpace']) && !empty($_POST['idOpenSpace'])){
	$idOpenSpace = $_POST['idOpenSpace'];
	$query = $room->filterOpenspaces($idOpenSpace);


}else{

	$query = $room->displayRooms();

}

if(isset($_POST['nameRoomSetMaintenance'])){ //A CORRIGER

	$nameRoom = $_POST["nameRoomSetMaintenance"];
	$room->setMaintenance($nameRoom);


}else if(isset($_POST['nameRoomUnsetMaintenance'])){
	$nameRoom = $_POST["nameRoomUnsetMaintenance"];
	$room->unsetMaintenance($nameRoom);
}

if(isset($_POST['id']) && isset($_POST['id_openspace']) && isset($_POST['type_openspace']) && isset($_POST['name_room'])){
	$idRoom = $_POST['id'];
	$idos = $_POST['id_openspace'];
	$type = $_POST['type_openspace'];
	$nameRoom = $_POST['name_room'];
	$room->updateRoom($idRoom, $idos, $type, $nameRoom);
}


if(isset($_POST['delete_room'])){

	$id = $_POST['delete_room'];
	$room->deleteRoom($id);
}
?>
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addRoom">Ajouter une salle</button>
<div class="table-responsive">
	<table class="table table-hover">
	<caption>Liste des salles Work'n Share</caption>

	<thead>
		<tr>
			<th>ID</th>
			<th>Type de salle</th>
			<th>Nom</th>
			<th>Statut</th>
			<th>Occupé par</th>
			<th>Action</th>
		</tr>
	</thead>

	<?php
		if(isset($query)){
			foreach ($query as $value) {

	?>

		<tbody id="roomMaintenance">
			<tr>
				<?php
				echo '<td> '.$value[0].' </td>';
				if($value[3] == 0){
					echo '<td> Cosy </td>';
				}else if($value[3] == 1){
					echo '<td> Réunion </td>';
				}else if($value[3] == 2){
					echo '<td> Appels </td>';
				}
				//NOM DE LA SALLE
				echo '<td>' . $value[2] .'</td>';
				//STATUT
				if($value[4] == 0){
					echo '<td> Disponible </td>';
				}else if($value[4] == 1){
					echo '<td> Occupé </td>';
				}else if($value[4] == 2){
					echo '<td> En maintenance </td>';
				}
				//OCCUPE PAR
				echo '<td> A venir </td>';
				echo '<td><button type="button" class="btn btn-info" data-toggle="modal">Consulter</button></td>';
				echo '<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#'.$value[0].$value[2].'">Modifier</button></td>';
				echo '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#'.$value[0].'">Supprimer</button></td>';

				echo $window->confirmAction('Etes-vous sûr de vouloir supprimer la salle n°'.$value[0].' '.$value[2].' ?', $value[0], 'deleteRoom('.$value[0].')');
				?>
				<div class="modal fade" id=<?php echo '"'.$value[0].$value[2].'"' ?> role="dialog">
					<div class="modal-dialog">


						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Modifier la salle n°<?=$value[0].' '.$value[2];?></h3>
									
							</div>
							<div class="modal-body">
								<div class="row">
								  	<div class="col-sm-5">Numéro de salle</div>
								  	<div class="col-sm-5"><?=$value[0]?></div>
								</div>

								<div class="row">
								  	<div class="col-sm-5">Créé le</div>
								  	<div class="col-sm-5">x</div>
								</div>
								<div class="row">
								  	<div class="col-sm-5">Type de salle</div>
								  	<div class="col-sm-5">
									  	<select id="selectTypeUpdate" class="form-control" >
										<?php
											for($i = 0; $i < count($typeRoom); $i++){


												if($typeRoom[$i]['typeRoom'] == 0){
													echo '<option > Cosy </option>';
												}else if($typeRoom[$i]['typeRoom'] == 1){
													echo '<option> Réunion </option>';
												}else if($typeRoom[$i]['typeRoom'] == 2){
													echo '<option> Appels </option>';
												}else{
													echo '<option> Indéfini </option>';
												}
											}
										?>
							

										</select>
									</div>
								</div>
								<div class="row">
								  	<div class="col-sm-5">Localisation</div>
								  	<div class="col-sm-5">
								  		<select id="selectOpenspaceUpdate" class="form-control">
								  		<?php
											foreach($result as $res){

												echo "<option id='idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
											}
						
										?>
										</select>
									</div>
								</div>
								<div class="row">
								  	<div class="col-sm-5">Nom de salle</div>
								  	<div class="col-sm-5"><input type="text" class="form-control" id=<?='"nameRoomUpdate'.$value[0].'"'?> value=<?='"'.$value[2].'"'?> placeholder="Entrez le nom de la salle"></input></div>
								</div>
								<div class="row">
									<div>
										<?php
											if($value[4] == 0){
												echo '<label>Mettre en maintenance</label>
														<br><p>Souhaitez-vous mettre en maitenance cette salle?</p>
														<p>Une fois la maintenance terminée, merci modifier le statut de la salle.</p>
														<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="
															setMaintenance(\''.$value[2].'\', 1)" 
														';

											}else if($value[4] == 2){
												echo '<label>Annuler la maintenance en cours</label>
														<br><p>Souhaitez-vous annuler la maintenance de cette salle?</p>
														<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="
															setMaintenance(\''.$value[2].'\', 0)" 
														';
											}
										?>
										<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="
										setMaintenance(<?="'".$value[2]."'"?>, 1)" 
										>Confirmer</button> <!-- SyntaxError: expected expression, got '}'-->
									</div>
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
								<button type="button" class="btn btn-success" id="nameRoom" data-dismiss="modal" onclick="updateRoom(<?=$value[0]?>)">Confirmer</button>
							</div>
						</div>
					</div>
				</div>
				<?php
				
			}//FIN DU FOREACH
		}
				?>
			</tr>
		</tbody>
	</table>
</div>


