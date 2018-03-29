<?php

//require "class/dataBaseClass.php";
require "class/roomClass.php";
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
$db->executeQuery();
$query = $db->fetchQuery();




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
				<th>Supprimer</th>
			</tr>
		</thead>
		
		<?php
			foreach ($query as $value) {

		?>

			<tbody>
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
					echo '<th><input type="button" id= "display" onclick="setMaintenance()" value="Set"></th>';

					echo '<th><a href="" >Voir la réservation </a></th>';

					echo '<th><input type="button" id= "display"></button value="Ok"></input </th>';
				}
					?>
				</tr>
			</tbody>
		</table>
