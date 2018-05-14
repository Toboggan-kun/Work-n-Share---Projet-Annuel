
<?php

require "class/bookingClass.php";
require "class/equipmentClass.php";
$equipment = new Equipment();
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
<caption><h3>Choisissez un lieu</h3></caption>
<div id="buttonOpenspace" style="display: none;" class="row">
	
	<div class="form-group col-lg-5">
	<?php
	if($result != null){

		echo '<select class="form-control input-lg" id="openspaceValue" onchange="getOpenspace()"> <option></option>';
		foreach ($result as $value) {
			
			//echo '<input type="button" value="'.$value[0].'">';
			echo ' 
					<option>'.utf8_encode($value[0]).'</option>
				';
		}
	}else{
		echo '<div class="alert alert-danger">
  				<strong>Nous sommes désolés</strong>Il semblerait qu\'il n\'y ait plus de salles disponible pour ce lieu.
			</div>';
	}
	
	
	?>
		</select>
	</div> 
</div>
<?php
}
if(isset($_POST['openspace']) && isset($_POST['type'])){ //SI CHOISI UN OPENSPACE AU CLIC BOUTON
	echo '<div class="col-lg-12">';
	switch ($_POST['openspace']) {

		case 'Bastille':
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.4710488448113!2d2.3659934155873437!3d48.84922737928658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6720246953c8d%3A0xcadfd7ad27504b7b!2sBoulevard+de+la+Bastille%2C+75012+Paris!5e0!3m2!1sfr!2sfr!4v1526256339120" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>';
		break;
		case 'République':
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.651761996441!2d2.3745768155879143!3d48.864850579288046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66dfad98e894d%3A0xb41806ebdd85ef6d!2sAvenue+de+la+R%C3%A9publique%2C+75011+Paris!5e0!3m2!1sfr!2sfr!4v1526258741495" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
			break;
		case 'Ternes':
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.8959595536276!2d2.2894334155884573!3d48.879259879289584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66f9292ba6313%3A0x29fbd42bb859e64e!2sAvenue+des+Ternes%2C+75017+Paris!5e0!3m2!1sfr!2sfr!4v1526258838559" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
			break;
		case 'Odéon':
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1312.71332582292!2d2.3399224429148124!3d48.850074096741764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671dc35ea02c5%3A0xb8688bbae6bb2ede!2sRue+Racine%2C+Paris!5e0!3m2!1sfr!2sfr!4v1526258961025" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
			break;
		case 'PlaceItalie':
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.4362994342437!2d2.353201415586642!3d48.83081597928483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6718dc54ebc1d%3A0x8b861434ae77979e!2sPlace+d&#39;Italie!5e0!3m2!1sfr!2sfr!4v1526259033091" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
			break;
		case 'Beaubourg':
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.762784508994!2d2.352101615587854!3d48.86273367928796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1b10beb621%3A0xcf72cba236ce65e0!2sRue+Beaubourg%2C+Paris!5e0!3m2!1sfr!2sfr!4v1526259081910" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
			break;
		default:
			echo '';
		break;
	}
	echo '<hr></div>';
	$res = $booking->choseRoom($_POST['openspace'], $_POST['type']);
	$numberRooms = count($res);

?>	
	<hr>
	<div id="selectRoomName" style="display: none;">
		<caption><h3>Choisissez une salle</h3></caption>
		<div class="row">
		<?php
			if($numberRooms == 1) echo '<div class="col-md-2"><label>'.$numberRooms.' salle est disponible</label></div>';
			if($numberRooms == 0) echo '<div class="alert alert-warning">
  				<strong>Nous sommes désolés </strong>Il semblerait qu\'il n\'y ait plus de salles disponible pour ce lieu.
			</div>';
			if($numberRooms > 1) echo '<div class="col-md-2"><label>'.$numberRooms.' salles sont disponibles</label></div>';
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
if(isset($_POST['date']) && isset($_POST['openspace2']) && isset($_POST['type']) && isset($_POST['room'])){ //AFFICHAGE DE LA PLAGE HORAIRE ENTRANCE
	$date = date("Y-m-d", strtotime($_POST['date'])); //RECONVERTI LE DATE TIME EN DATE UNIQUEMENT
	//$rooms = $booking->roomAvailable($_POST['type'], $_POST['openspace'], $date);
	//$res = count($rooms);

	$error1 = $booking->checkDate($_POST['date']);
	//$error2 = $booking->isEmpty($res, 9);

	if($error1){


		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo '
				<div id="errors" class="alert alert-warning">';
			//var_dump($_SESSION["error"]);
			echo '	<strong>Nous sommes navrés </strong> '.$_SESSION['error'][0];
			echo '
				</div>';
		}
				
	}else{

		$openspace = $_POST['openspace2'];
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
													$i++;
													;
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
if(isset($_POST['entrance']) && isset($_POST['day_booking']) && isset($_POST['nameOpenspace_booking']) && isset($_POST['room_value']) && isset($_POST['date_value'])){
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

		//RECUPERE LHEURE DARRIEE ET DE FIN DUNE RESERVATION
		$values = $booking->calculSchedule($_POST['date_value'], $_POST['room_value']);
		if($values != null){
			$scheduleAvailable = explode('-', $values);

			$gap = $scheduleAvailable[1] - $scheduleAvailable[0]; //HEURE DE FIN - HEURE DE DEPART
		}

		$thisDay = mktime(0, 0, 0, $month, $day, $year);
		$thisDay = date('N', $thisDay);
		$hours = $booking->loadScheduleByDay($thisDay, $openspace);

		$endSchedule = date("H:i", strtotime($hours[0]['closeHour']));
		
		echo '<div id="hourExit" style="display: none;">
				<div class="row">
				<div class="col-md-4"><h3>Jusqu\'à</h3></div>
					<div class="col-md-8">
						<select id="selectedHourExit" class="form-control input-lg" onchange="getHourExit()">';
							$hour = date("H:i", strtotime($hours[0]["openHour"])); //CONVERTI EN 00:00
							if(isset($selectedHourEntrance)){
								$res = date('H:i', strtotime($hours[0]['closeHour'])) - $selectedHourEntrance;
								if($res == 0){
									echo '<option>Fermé</option>';
								}else{
									echo '<option></option>';
									//for($i = 0; $i < $res; $i++){
									while($selectedHourEntrance != $scheduleAvailable[0]){

										//if($hour == $scheduleAvailable[0]){
											//return;
											/*$gap = $scheduleAvailable[0] - $hour;
											for($i = 0; $i < $gap; $i++){
												//REND INSAISISSABLE LES HORAIRES INDISPONIBLES
												echo '<option disabled="disabled" style="color: red;">'.$hour.'</option>'; //LES HORAIRES SONT AFFICHES INDISPONIBLES
												$hour = date("H:i", strtotime($hour."+1 hours"));
											}*/
										//}
										$selectedHourEntrance = date("H:i", strtotime($selectedHourEntrance.'+1 hours'));
										echo '<option>'.$selectedHourEntrance.'</option>';
										if($selectedHourEntrance == $endSchedule){
											return;
										}

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
		$stuff = $equipment->countEquipmentByType('Multiprise à 4 entrées');
		$stuff2 = $equipment->countEquipmentByType('Ordinateur portable');

	echo "<div id=\"equip\" style=\"display: none;\" class=\"well well-lg\">";
	echo "	
	
		<div class=\"page-header\">
		  <h2>Options</h2>
		</div>
		<h3>Equipements inclus</h3>
		<div class=\"row col-lg-12\" id=\"equipmentsIncluded\">
		  <h4><div class=\"col-sm-2\"><i class=\"fas fa-wifi\"></i><p>Wifi très haut débit</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-coffee\"></i><p>Boissons à volonté</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-print\"></i><p>Imprimante à libre service</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-plug\"></i><p>4 prises électriques</p></div>
		  <div class=\"col-sm-2\"><i class=\"fas fa-phone-volume\"></i><p>Cabines téléphoniques</p></div></h4>
		</div>
		<div class=\"well well-lg\">
		<div class='col-lg-12'>";
			if($stuff != 0 && $stuff2 != 0){
				echo "<h3>Ajouter des équipements</h3>";
			}
			
			if($stuff[0]['COUNT(typeEquipment)'] == '0'){
				echo '';
			}else{
				echo "<div class='col-md-4'>
				<h4><i class=\"fas fa-plug\"></i>   Multiprise 4 prises 3,50€</h4>
				</div>
				<div class='col-sm-7' onchange='getQuantityOnchange()'>
					<input class=\"form-control input-lg\" type=\"range\" value=\"0\" min=\"0\" max=".$stuff[0]['COUNT(typeEquipment)']." id=\"equip4\">
				</div>
				<div class='col-sm-1' id='qty_data'>
					<h4>0</h4>
				</div>

			</div>";
			}
		if($stuff2[0]['COUNT(typeEquipment)'] == '0'){
			echo '';
		}else{
			echo 
		"<div class='row'>
			<div class='col-md-4'>
				<h4><i class=\"fas fa-laptop\"></i>   Ordinateur portable 15,00€</h4>
			</div>

			<div class='col-sm-7'>
				<input class=\"form-control input-lg\" type=\"range\" value=\"0\" min=\"0\" max=".$stuff2[0]['COUNT(typeEquipment)']." id=\"computer\" onchange='getQuantityOnchange()'>
			</div>
			<div class='col-sm-1' id='qty_data2'>
				<h4>0</h4>
			</div>
		</div>";
		}
		
		echo
		"<div class'well well-lg'>
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
			
		echo '</div>';

		echo '
		<div class="row">
			<div class="col-sm-11">
				<input class="form-control input-lg" type="range" value="0" min="0" max="10" id="qtyMenu">
			</div>
			<div class="" id="qty_data3">
				<h4>0</h4>
			</div>
		</div>
			<div id="messagesErrors"></div> <!-- AFFICHE LES MESSAGES D\'ERREURS -->
				<ul class="pager">
		
				  <li class="next"><a onclick="getQuantity()">Passer à l\'étape suivante</a></li>
				</ul>
			</div>
		</div>
			';
		echo '</div></div>';
	}
}
?>

<script type="text/javascript" src="js/script.js"></script>
