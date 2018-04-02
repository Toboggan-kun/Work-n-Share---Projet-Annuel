<?php

//require "class/dataBaseClass.php";
require "class/roomClass.php";
require "class/windowClass.php";
$db = new DataBase();
$db->connectDataBase();

$room = new Room();
if(isset($_POST['idOpenSpace']) && $_POST['idOpenSpace'] != null){

	$idOpenSpace = $_POST['idOpenSpace'];
	$query = $db->prepareQuery	('
		SELECT 	*
		FROM 	room
		WHERE 	idOpenSpace IN(
		SELECT 	O.idOpenSpace AS idO
		FROM 	openspace O
		WHERE 	idOpenSpace = "'.$idOpenSpace.'")
								');


}else{

	$db->prepareQuery('SELECT * FROM room ORDER BY idOpenSpace');

}

if(isset($_POST['nameRoomSetMaintenance'])){

	$nameRoom = $_POST["nameRoomSetMaintenance"];
	$room->setMaintenance($nameRoom);

}else if(isset($_POST['nameRoomUnsetMaintenance'])){

	$nameRoom = $_POST["nameRoomUnsetMaintenance"];
	$room->unsetMaintenance($nameRoom);
}else if(isset($_POST['deleteRoom'])){

	$nameRoom = $_POST["deleteRoom"];
	$room->deleteRoom($nameRoom);
}else if(isset($_POST['addRoom'])){
	$nameRoom = $_POST['addRoom'];
	$array = explode('|', $nameRoom);
	$room->addRoom($array[0], $array[1], $array[2]);
}

$db->executeQuery();
$query = $db->fetchQuery();

$window = new Window();



?>
		<table>
		<caption>Liste des salles Work'n Share</caption>

		<thead>
			<tr>
				<th>Type</th>
				<th>Nom</th>
				<th>Statut</th>
				<th>Occupé par</th>
				<th>En maintenance</th>
				<th>Consulter</th>
				<th>Action</th>
			</tr>
		</thead>

		<?php
			foreach ($query as $value) {
				$box1 = $window->createBox("Etes-vous sûr de vouloir mettre en maintenance la salle ".$value[2]."?");
				//$errorBox = $window->errorBox("Cette salle existe déjà.");

		?>

			<tbody id="roomMaintenance">
				<tr>
					<?php

					if($value[3] == 0){
						echo '<th> Cosy </th>';
					}else if($value[3] == 1){
						echo '<th> Réunion </th>';
					}else if($value[3] == 2){
						echo '<th> Appels </th>';
					}
					//NOM DE LA SALLE
					echo '<th>' . $value[2] .'</th>';
					//STATUT
					if($value[4] == 0){
						echo '<th> Disponible </th>';
					}else if($value[4] == 1){
						echo '<th> Occupé </th>';
					}else if($value[4] == 2){
						echo '<th> En maintenance </th>';
					}
					//OCCUPE PAR
					echo '<th> A venir </th>';
					if($value[4] == 0){
						echo '<th><input type="button" id="room" onclick="setMaintenance(\''.$value[2].'\', 1)" value="Mettre en maintenance"></th>';
					}else if($value[4] == 2){
						echo '<th><input type="button" id="room" onclick="setMaintenance(\''.$value[2].'\', 0)" value="Annuler la maintenance"></th>';
					}
					

					echo '<th><a href="" >Voir la réservation </a></th>';

					echo '<th><input type="button" id="'.$value[2].'" value="Supprimer" onclick="deleteRoom(\''.$value[2].'\')"></input> </th>';
				}
					?>
				</tr>
			</tbody>
		</table>
