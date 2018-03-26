<?php
session_start();
include "header.php";

require "class/dataBaseClass.php";
require "class/windowClass.php";

$db = new DataBase();
$db->connectDataBase();
$db->prepareQuery("SELECT * FROM openspace ORDER BY idOpenSpace");
$db->executeQuery();
$result = $db->fetchQuery();

?>

<center>

	<h1> Administration Work'n Share </h1>
	

	<form method="POST">
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
	
</center>