<?php
include "header.php";

require "class/windowClass.php";
require "class/bookingClass.php";
$booking = new Booking();
$roomBox = new Window();
$db = new DataBase();
$db->prepareQuery('SELECT DISTINCT typeRoom FROM room');
$db->executeQuery();
$result = $db->fetchQuery();


?>
<div id="mainDiv">

<div class="page-header">
  <h1>Réservation</h1>
</div>
<div id="bookingFormStep2"></div>
<div id="bookingFormStep1">
	<h2>Informations de la réservation</h2>

	
	<table>
		<caption><h3>Choisissez le type d'espace qui vous correspond</h3></caption>
		<tbody>
			<?php
				foreach ($result as $value) {
					if(intval($value[0]) == 1){
						echo '<th>'.$roomBox->createMiniatureRoomBox("Salle de Réunion", "Cette salle est parfaitement équipée pour organiser vos réunions", $value[0]).'<button type="button" class="btn btn-link" id="cosy">Visualiser la salle</button></th>';

					}else if(intval($value[0])  == 2){
						echo '<th>'.$roomBox->createMiniatureRoomBox("Salle d'Appel", "Undefined", $value[0]).'<button type="button" class="btn btn-link">Visualiser la salle</button></th>';
					}else if(intval($value[0]) == 0){
						echo '<th>'.$roomBox->createMiniatureRoomBox("Salon Cosy", "La salle idéale pour lire, discuter avec confort", $value[0]).'<button type="button" class="btn btn-link">Visualiser la salle</button></th>';
					}

				}

			?>
		</tbody>
	</table>

	<div id="buttonOpenspaceArray"></div>
	<div id="selectRoom"></div>
	<div id="selectDate"></div>
	<div id="selectScheduleEntrance"></div>
	
	<div id="selectScheduleExit"></div>
	<!--<div id="nbPerson" style="display: none;">
		<h3>Nombre de personnes (6 maximum)</h3>
		<select id="nbCustomers">

			<option>Sélectionnez un nombre de personnes</option>
			<?php

				/*for($i = 1; $i <= 6; $i++){
					echo '<option>'.$i.'</option>';
				}*/
			?>
		</select>
	</div>-->
	<div id="selectOptions"></div>
</div>
<script type="text/javascript" src="js/script.js"></script>
</div>
<?php

include "footer.php";
?>
