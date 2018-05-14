<?php
include "header.php";

require "class/windowClass.php";
require "class/bookingClass.php";
require "class/userClass.php";

$user = new User();
$booking = new Booking();
$roomBox = new Window();
$db = new DataBase();
$db->prepareQuery('SELECT DISTINCT typeRoom FROM room');
$db->executeQuery();
$result = $db->fetchQuery();
$user_data = $user->laodUserById(1);
$subscription = $user->convertIntSubtoString($user_data[0]['subscription']);
if($user_data[0]['subscription'] == 1 || $user_data[0]['subscription'] == 3){
	$engagement = "sans engagement";
}else if($user_data[0]['subscription'] == 2 || $user_data[0]['subscription'] == 4){
	$engagement = "avec engagement";
}
?>
<div class="well well-lg"><h3>Vous possedez actuellement l'abonnement : <b><?=$subscription?> <?=$engagement?></b></h3></div>
<div id="mainDiv">


<div id="bookingFormStep2"></div>
<div class="col-sm-12">

<div id="bookingFormStep1"  class="well well-lg">
	<div class="page-header">
	  <h1>Réservation</h1>
	</div>
	<h2>Informations de la réservation</h2>

	
	
		<caption><h3>Choisissez le type d'espace qui vous correspond</h3></caption>
		<br><br>
		<div class="row">
			<?php
				foreach ($result as $value) {
					if(intval($value[0]) == 1){
						echo $roomBox->createMiniatureRoomBox("Salle de Réunion", "Cette salle est parfaitement équipée pour organiser vos réunions", $value[0]);

					}else if(intval($value[0])  == 2){
						echo $roomBox->createMiniatureRoomBox("Salle d'Appel", "Undefined", $value[0]);
					}else if(intval($value[0]) == 0){
						echo $roomBox->createMiniatureRoomBox("Salon Cosy", "La salle idéale pour lire, discuter avec confort", $value[0]);
					}

				}

			?>
		</div>
		<hr>

	

	<div id="buttonOpenspaceArray"></div>
	<hr>
	<div id="selectRoom"></div>
	<hr>
	<div id="selectDate"></div>
	<hr>
	<div id="selectScheduleEntrance"></div>
	<hr>
	
	<div id="selectScheduleExit"></div>
	<hr>
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
</div>
	<div id="selectOptions"></div>
</div>
<script type="text/javascript" src="js/script.js"></script>
</div>
<?php

include "footer.php";
?>
