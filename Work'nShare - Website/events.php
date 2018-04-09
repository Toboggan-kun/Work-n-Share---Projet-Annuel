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
		<div id="eventFormContainer">
		<form action="" method="POST">
			<span id="editProfileFormSpan">
				<!-- PLUS TARD <label>Ajouter une image (JPG, JPEG, PNG | xKo Maximum)</label><input type="file" name="image"><br>-->
				<span>Titre de l'évenement</span><span><input type="text" placeholder="Titre" required="required" id="titleEvent"></input></span><br>
				<span>Adresse</span><span><input type="text" placeholder="Adresse" required="required" id="addressEvent"></input></span><br>
				<span>Date prévue</span><span><input type="date" placeholder="Titre" required="required" id="dateEvent"></input></span><br>
				<span>Heure prévue</span><span><input type="time" placeholder="Titre" required="required" id="hourEvent"></input></span><br>
				<span>Description</span><span><span><textarea row="10" cols="50" required="required" placeholder="Votre description" id="descriptionEvent"></textarea></span><br>
				<input type="button" value="Annuler" onclick="closePopup()">
				<input type="button" value="Ajouter" onclick="addEvent()">
			</span>
		</form>
	</div>
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


