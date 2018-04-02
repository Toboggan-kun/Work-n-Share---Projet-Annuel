<?php

include "header.php";
require "class/eventClass.php";
require "class/windowClass.php";

$galery = new Window();
$event = new Event();
$db = new DataBase();
$db->connectDataBase();
$db->prepareQuery('SELECT * FROM event');
$db->executeQuery();
$result = $db->fetchQuery();
?>

<h2>Gestion des évenements</h2>
<section id="background">
	
	<div id="window2">
		<h2>Création d'un évènement</h2>
		<form action="" method="POST">
			<!-- PLUS TARD <label>Ajouter une image (JPG, JPEG, PNG | xKo Maximum)</label><input type="file" name="image"><br>-->
			<label>Titre de l'évenement</label><input type="text" placeholder="Titre" required="required" id="titleEvent"></input><br>
			<label>Adresse</label><input type="text" placeholder="Adresse" required="required" id="addressEvent"></input><br>
			<label>Date prévue</label><input type="date" placeholder="Titre" required="required" id="dateEvent"></input><br>
			<label>Heure prévue</label><input type="time" placeholder="Titre" required="required" id="hourEvent"></input><br>
			<label>Description</label><textarea row="10" cols="50" required="required" placeholder="Votre description" id="descriptionEvent"></textarea><br>
			<input type="button" value="Annuler" onclick="closePopup()">
			<input type="button" value="Ajouter" onclick="addEvent()">

		</form>
	<div>
</section>
	<section id="miniatureEvent">
		<ul id="eventArrayMiniature">
			<table>
				<caption>Derniers évènements</caption>
				<thead>
					<tr>
						<?php

							$count = $event->isEmpty();
	
							if($count == 0){

								echo '<th>Aucun évenement créé</th>';
							}else{

								foreach($result as $array){
									
									echo '<th>'.$galery->createMiniatureEventBox($array[1], $array[6]).'</th>';
								}
								
							}

						
						?>
					</tr>
				</thead>
			</table>
			

		</ul>
	</section>
	<input type="button" value="Créer un évènement" onclick="showPopup()">


