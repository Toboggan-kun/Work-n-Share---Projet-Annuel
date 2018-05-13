
<?php


require "class/bookingClass.php";
$booking = new Booking();
$db = new DataBase();

$db->prepareQuery('SELECT * FROM menu WHERE stateMenu = 1');
$db->executeQuery();
$menu = $db->fetchQuery();


$db->prepareQuery('SELECT DISTINCT idOpenSpace, nameOpenSpace FROM openspace');
$db->executeQuery();
$nameOpenSpace = $db->fetchQuery();
if(isset($_SESSION['error'])){
	unset($_SESSION['error']);
	
}
if(isset($_POST['typeRoom'])){

	$type = $_POST['typeRoom'];
	$result = $booking->openspacesAvailable($type);


?>
<div id="buttonOpenspace" style="display: none;">
	<caption><h3>Choisissez un lieu</h3></caption>
	<div class="row">
	<?php
	if($result != null){
		foreach ($result as $value) {
			//echo '<input type="button" value="'.$value[0].'">';
			echo '<th><button id="openspaceValue" type="button" onclick="getOpenspace(\''.utf8_encode($value[0]).'\')" value="\''.utf8_encode($value[0]).'\'" class="btn btn-info btn-lg">'.utf8_encode($value[0]).' </button></th>';
		}
	}else{
		echo '<div class="alert alert-danger">
  				<strong>Nous sommes désolés</strong>Il semblerait qu\'il n\'y ait plus de salles disponible pour ce lieu.
			</div>';
	}
	?>

	</div>


<div>
<?php
}
if(isset($_POST['openspace']) && isset($_POST['type'])){ //SI CHOISI UN OPENSPACE AU CLIC BOUTON

	$res = $booking->choseRoom($_POST['openspace'], $_POST['type']);
	$numberRooms = count($res);

?>	
	<div id="selectRoomName" style="display: none;">
		<div class="row">
		<?php
			if($numberRooms == 1) echo '<div class="col-md-2"><h3>'.$numberRooms.' salle est disponible</h3></div>';
			if($numberRooms == 0) echo '<div class="alert alert-warning">
  				<strong>Nous sommes désolés </strong>Il semblerait qu\'il n\'y ait plus de salles disponible pour ce lieu.
			</div>';
			if($numberRooms > 1) echo '<div class="col-md-2"><h3>'.$numberRooms.' salles sont disponibles</h3></div>';
		?>
		
			<select id="room" class="form-control input-lg" onchange="getRoom()">
				<option></option>
				<?php

					foreach ($res as $value) {
						echo '<option>'.$value[1].'</option>';
					}
				?>
				
			</select>
		</div>
	</div>
<?php
}
if(isset($_POST['room'])){

	$error = $booking->isEmpty($_POST['room'], 10);

	if($error){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo '<div id="inputDate" style="display: none;">
			<div id="errors" class="alert alert-danger">';
			//var_dump($_SESSION["error"]);
			echo '<strong>Attention ! </strong> '.$_SESSION['error'][0];	
			echo '</div></div>';
		}
	}

?>
	<div id="inputDate" style="display: none;">
		<div class="row">
		<div class="col-md-4"><h3>Choisissez une date</h3></div>

		<?php
			
			$currentDate = date("Y-m-d");

			echo '<div class="col-md-8"><input class="form-control input-lg" id="calendar" type="date" min="'.$currentDate.'" onchange="getDate()"></div>';


		?>
		</div>
	</div>
<?php
}
if(isset($_POST['date']) && isset($_POST['openspace']) && isset($_POST['type']) && isset($_POST['room'])){ //AFFICHAGE DE LA PLAGE HORAIRE ENTRANCE
	$date = date("Y-m-d", strtotime($_POST['date'])); //RECONVERTI LE DATE TIME EN DATE UNIQUEMENT
	//$rooms = $booking->roomAvailable($_POST['type'], $_POST['openspace'], $date);
	//$res = count($rooms);

	$error = $booking->checkDate($_POST['date']);
	//$error2 = $booking->isEmpty($res, 9);

	if($error == true){

		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo '<div id="hourEntrance" style="display: none;">
			<div id="errors" class="alert alert-warning">';
			//var_dump($_SESSION["error"]);
			echo '<strong>Nous sommes navrés </strong> '.$_SESSION['error'][0];	
			echo '</div></div>';
		}
				
	}else{

		$openspace = $_POST['openspace'];
		$array = explode('-', $_POST['date']);
		$year = $array[0];
		$month = $array[1];
		$day = $array[2];

		//CONNAITRE LE JOUR D'UNE DATE
		$thisDay = mktime(0, 0, 0, $month, $day, $year);
		$thisDay = date('N', $thisDay);
		//RECUPERE LHEURE DOUVERTURE ET DE FERMETURE
		$hours = $booking->loadScheduleByDay($thisDay, $openspace);

		//RECUPERE LHEURE DARRIEE ET DE FIN DUNE RESERVATION
		$values = $booking->calculSchedule($_POST['date'], $_POST['room']);
		if($values != null){
			$scheduleAvailable = explode('-', $values);

			$gap = $scheduleAvailable[1] - $scheduleAvailable[0]; //HEURE DE FIN - HEURE DE DEPART
		}
		

		echo '<div id="hourEntrance" style="display: none;">
				<div class="row">
					<div class="col-md-4"><h3>Heure d\'arrivée à partir de </h3></div>
						<div class="col-md-8">
							<select id="selectedHourEntrance" class="form-control input-lg" onchange="getHour(\'hourExit\')">
							
									<option></option>
									';
									$hour = date("H:i", strtotime($hours[0]["openHour"])); //CONVERTI EN 00:00
									$res = $hours[0]["closeHour"] - $hours[0]["openHour"];

									//$unvailable = $booking->calculSchedule($day, )
									for($i = 0; $i < $res; $i++){

										if($values != null){
											if($hour == $scheduleAvailable[0]){

												for($i = 0; $i < $gap; $i++){
													//REND INSAISISSABLE LES HORAIRES INDISPONIBLES
													echo '<option disabled="disabled" style="color: red;">'.$hour.'</option>'; //LES HORAIRES SONT AFFICHES INDISPONIBLES
													$hour = date("H:i", strtotime($hour."+1 hours"));
												}
											}
											
										}
										echo '<option>'.$hour.'</option>';
										$hour = date("H:i", strtotime($hour."+1 hours"));
									}

							

							echo '</select>
						</div>
				</div>
			</div>';	
	}
	
}


?>

<?php
if(isset($_POST['entrance']) && isset($_POST['day_booking']) && isset($_POST['nameOpenspace_booking'])){
	$error = $booking->isEmpty($_POST['entrance'], 8);
	if($error){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo '<div id="hourExit" style="display: none;"><div id="errors" class="alert alert-danger">';
			//var_dump($_SESSION["error"]);
			echo '<strong>Attention !</strong> '.$_SESSION['error'][0];	
			echo '</div></div>';

		}
		
	}else{
		
		$selectedHourEntrance = $_POST['entrance'];
		$thisDay = $_POST['day_booking'];
		$openspace = $_POST['nameOpenspace_booking'];
		$array = explode('-', $_POST['day_booking']);
		$year = $array[0];
		$month = $array[1];
		$day = $array[2];

		$thisDay = mktime(0, 0, 0, $month, $day, $year);
		$thisDay = date('N', $thisDay);
		$hours = $booking->loadScheduleByDay($thisDay, $openspace);
		echo '<div id="hourExit" style="display: none;">
				<div class="row">
				<div class="col-md-4"><h3>Jusqu\'à</h3></div>
					<div class="col-md-8">
						<select id="selectedHourExit" class="form-control input-lg" onchange="getHourExit()">';
						
							if(isset($selectedHourEntrance)){
								$res = date('H:i', strtotime($hours[0]['closeHour'])) - $selectedHourEntrance;
								if($res == 0){
									echo '<option>Fermé</option>';
								}else{
									echo '<option></option>';
									for($i = 0; $i < $res; $i++){
										$selectedHourEntrance = date("H:i", strtotime($selectedHourEntrance.'+1 hours'));
										echo '<option>'.$selectedHourEntrance.'</option>';

									}
								}
							}else{
								echo '<option>Fermé</option>';
							}
						
					echo '
						</select>
					</div>
				</div>';
	}
}//FIN DU ISSET

if(isset($_POST['exit'])){
	$error = $booking->isEmpty($_POST['exit'], 8);
	if($error){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo '<div id="equip" style="display: none;"><div id="errors" class="alert alert-danger">';
			//var_dump($_SESSION["error"]);
			echo '<strong>Attention !</strong> '.$_SESSION['error'][0];	
			echo '</div></div>';

		}
	}else{
	echo "	
	<div id=\"equip\" style=\"display: none;\">
		<div class=\"page-header\">
		  <h2>Options</h2>
		</div>
		<h3>Equipements inclus</h3>
		<div class=\"row\" id=\"equipmentsIncluded\">
		  <div class=\"col-sm-2\"><i class=\"fas fa-wifi\"></i><p>Wifi très haut débit</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-coffee\"></i><p>Boissons à volonté</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-print\"></i><p>Imprimante à libre service</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-plug\"></i><p>4 prises électriques</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-phone-volume\"></i><p>Cabines téléphoniques</p></div>
		</div>
		<div>
			
		<h3>Ajouter des équipements</h3>
		<div class=\"col-md-4\"><h3>Multiprise 4 prises 3,50€</h3></div>
			<div class=\"col-md-8\">

			</div>
		</div>
		<p><i class=\"fas fa-plug\"></i>Multiprise 4 prises 3,50€<input class=\"form-control input-lg\" type=\"range\" value=\"0\" min=\"0\" max=\"10\" id=\"equip4\"></p>

		<p><i class=\"fas fa-laptop\"></i>Ordinateur portable 15,00€<input class=\"form-control input-lg\" type=\"range\" value=\"0\" min=\"0\" max=\"10\" id=\"computer\"></p>

		<h3><i class=\"fas fa-utensils\"></i>Une petite faim?</h3>
		<p>Les plateaux devront être récupérés dans la cafetériat de l'openspace. Vous devez vous munir de votre code de réservation qui vous sera fourni.</p>";

				foreach ($menu as $value) {
					echo '<div class="panel-heading">Menu du jour</div>
						<div class="panel-body">
						<p>Nom menu : '.$value[1].'</p>
						<li>Entrée :'.$value[2].'</li>
						<li>Plat :'.$value[3].'</li>
						<li>Dessert :'.$value[4].'</li>
						<li>Boisson: au choix</li>
						<p>Prix: 4,90€</p></div>';
				}
				if($menu == null || empty($menu)){
					echo '<p>Pas de menu du jour';
				}
			


		echo '<input type="range" value="0" min="0" max="10" id="qtyMenu">
				<div id="messagesErrors"></div> <!-- AFFICHE LES MESSAGES D\'ERREURS -->
				<ul class="pager">
		
				  <li class="next"><a onclick="getQuantity()">Passer à l\'étape suivante</a></li>
				</ul>
			</div>';
	}
}
?>

<script type="text/javascript" src="js/script.js"></script>
