<?php
session_start();
include "header.php";

//require "class/dataBaseClass.php";
require "class/windowClass.php";
require "class/formClass.php";
require "class/roomClass.php";


$form = new Form($_POST);
$db = new DataBase();
$db->connectDataBase();

$db->prepareQuery("SELECT * FROM openspace ORDER BY idOpenSpace");
$db->executeQuery();
$result = $db->fetchQuery();


$db->prepareQuery("SELECT DISTINCT typeRoom FROM room");
$db->executeQuery();
$typeRoom = $db->fetchQuery();

?>

<center>

	<h1> Administration Work'n Share </h1>
	

	<form action = "" method="POST">
		<fieldset style="width: 700px">
			<legend>Sélectionner un Open Space</legend>
			<label>Lieu</label>

			<select  id="selectOpenspace" name="selectOpenspace" onchange="refreshArray()">
				<option></option>
			
			<?php
			foreach($result as $res){

				echo "<option id = 'idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
			}
			?>
				

			</select>
		</fieldset>	
	</form>
	<div id="response"></div>
	<?php
		$popup = new Window();
		echo $popup->createBox('Voulez vous mettre en maintenance cette salle?');

	?>

	<form action="">
		<fieldset style="width: 700px">
			<legend>Ajouter une salle</legend>
			<label>Lieu</label>
			<select id="selectIdOpenspace">
				<option></option>
			
				<?php
				foreach($result as $res){

					echo "<option id = 'idOption' value='" . $res[0] . "'>" . $res[1] ."</option>";
				}

				?>
			</select>

			<br><br><label>Type de salle</label>
			<select id="selectType">
				<option></option>
				<?php
				
				for($i = 0; $i < count($typeRoom); $i++){


					if($typeRoom[$i]['typeRoom'] == 0){
						echo '<option> Cosy </option>';
					}else if($typeRoom[$i]['typeRoom'] == 1){
						echo '<option> Réunion </option>';
					}else if($typeRoom[$i]['typeRoom'] == 2){
						echo '<option> Appels </option>';
					}
				}

				?>
				
			</select>
			<br><br><label>Nom</label>
				<?php
					//echo $form->input('nameOpenSpace');
					echo '<input id="nameRoom" type="text" placeholder="Nom de la nouvelle salle"></input>';
					echo '<br><br><br><input type="button" onclick="addRoom()" value="Ajouter"></input>';

				?>

		</fieldset>
	</form>
	
</center>