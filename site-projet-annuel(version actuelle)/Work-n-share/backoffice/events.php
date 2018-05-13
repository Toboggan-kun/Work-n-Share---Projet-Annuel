<?php

include "header.php";
require "class/eventClass.php";
require "class/windowClass.php";

$window = new Window();
$event = new Event();
$db = new DataBase();

$db->prepareQuery('SELECT idOpenSpace, nameOpenspace FROM openspace');
$db->executeQuery();
$openspace = $db->fetchQuery();
$db->prepareQuery('SELECT * FROM event');
$db->executeQuery();
$result = $db->fetchQuery();


?>

<div class="page-header">
  <h2>Gestion des évènements</h2>
</div>
<?php
	if(isset($_SESSION['success'])  && !empty($_SESSION['success'])){
		echo '<div class="alert alert-success alert-dismissible fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>';
		foreach ($_SESSION['success'] as $value) {
			
			echo '<li><span class="glyphicon glyphicon-ok"></span>'.$value.'</li>';

		}

		echo '</ul>
			</strong>
		</div>';
	}

?>
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addEvent">Ajouter un évènement</button>

<div class="modal fade" id="addEvent" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-header"></div>

		<div class="modal-content">
		<!-- CHARGE LES MESSAGES D'ERREURS -->
			<div id="headerFormEvent" class="modal-header">
				
			</div>
			<br><br>
			<div class="modal-body">
			
				<form class="form-horizontal">
					<div class="form-group" >
					    <label class="control-label col-sm-4">Titre de l'évenement* </label>
					    <div class="col-sm-6">
					    	<input type="text" class="form-control input-lg" id="titleEvent" placeholder="Entrez un titre" maxlength="100">
					    	<small>Donnez un simple titre accrocheur !</small>
					    </div>

					</div>
					<div class="form-group" >
					    <label class="control-label col-sm-4">Lieu de rencontre* </label>
					    <div class="col-sm-6">
					    	<select id="os" class="form-control input-lg">
					    		<option></option>
					    		<?php
					    			foreach ($openspace as $value) {
					    				if($value[0] == 1){
											echo '<option>Bastille</option>';
										}else if($value[0] == 2){
											echo '<option>République</option>';
										}else if($value[0] == 3){
											echo '<option>Odéon</option>';
										}else if($value[0] == 4){
											echo '<option>Place d\'Italie</option>';
										}else if($value[0] == 5){
											echo '<option>Ternes</option>';
										}else if($value[0] == 6){
											echo '<option>Beaubourg</option>';
										}
					    			}
					    		?>
					    	</select>
					    </div>

					</div>

					<div id="address" class="form-group" onchange="displayAddressForm()">
					    <label class="control-label col-sm-4">Ou spécifier un autre lieu?</label>
					    <div class="radio">
						  <label class="radio-inline"><input type="radio" name="optradio" id="noEvent" checked="checked">Non</label>
						   <label class="radio-inline"><input type="radio" name="optradio" >Oui</label>
						</div>
					</div>
					<script type="text/javascript" src="js/script.js" onload="displayAddressForm()"></script>
					<div id="hidden" style="display: none"> <!-- BALISE CACHEE -->
						<div class="form-group">
						    <label class="control-label col-sm-4">Adresse*</label>
						    <div class="col-sm-6">
						    	<input type="text" class="form-control input-lg" id="addressEvent" placeholder="Entrez l'adresse" readonly="readonly" maxlength="100">
						    	<small >242 Rue du Faubourg Saint-Antoine ...</small>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-4">Code Postal*</label>
						    <div class="col-sm-6">
						    	<input type="text" class="form-control input-lg" id="postalCodeEvent" placeholder="Entrez le code postal" maxlength="5" readonly="readonly">
						    	<small >75012, 94200...</small>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-4">Ville*</label>
						    <div class="col-sm-6">
						    	<input type="text" class="form-control input-lg" id="cityEvent" placeholder="Entrez le nom de la ville" maxlength="20" readonly="readonly">
						    	<small >Paris, Marseille...</small>
						    </div>
						</div>
					</div> 
					<div class="form-group">
					    <label class="control-label col-sm-4">Date prévue*</label>
					    <div class="col-sm-6">
					    	<input type="date" class="form-control input-lg" id="dateEvent" min="<?=$_SESSION['currentDateEN']?>" required="required">

					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-4">Heure prévue*</label>
					    <div class="col-sm-6">
					    	<input type="time" class="form-control input-lg" id="hourEvent">

					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-4">Description*</label>
					    <div class="col-sm-6">
					    	<textarea class="form-control input-lg" id="descriptionEvent"></textarea>

					    </div>
					</div>


					<p>* : champs obligatoires</p>
				</form>
			</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
			<button type="button" class="btn btn-success btn-lg" onclick="addEvent()">Ajouter</button>
		</div>

				

		</div>
	</div>
</div>
<?php

	foreach ($result as $value) {


		$date_create = date("d-m-Y", strtotime($value[2]));
		$date_rdv = date("d-m-Y", strtotime($value[3]));
		$hour = date('H:i', strtotime($value[4]));
		echo '<div class="modal fade" id="consultEvent'.$value[0].'" role="dialog">';


?>

	<div class="modal-dialog modal-lg">
		<div class="modal-header"></div>

		<div class="modal-content">
		<!-- CHARGE LES MESSAGES D'ERREURS -->
			<div id="headerFormEvent" class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<?php

					
						echo' <h2 class="modal-title">Fiche de l\'évènement "'.$value[1].'"</h2>';
						
						$openspaceString = $event->convertIntOpenspaceToString($value[9]);
				?>
				
			</div>
			<br><br>
			<div class="modal-body">
				
				<form class="form-horizontal">
					<div class="form-group">
					    <label class="control-label col-sm-4">Date de création</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"><?=$date_create?></p>

					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-4">Auteur de l'article</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"></p>

					    </div>
					</div>
					<div class="form-group" >
					    <label class="control-label col-sm-4">Titre de l'évenement</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"><?=$value[1]?></p>
					    </div>

					</div>
					<div class="form-group" >
					    <label class="control-label col-sm-4">Lieu de rencontre</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"><?=$openspaceString?></p>
					
					    </div>

					</div>

					<div id="hidden"> <!-- BALISE CACHEE -->
						<div class="form-group">
						    <label class="control-label col-sm-4">Adresse</label>
						    <div class="col-sm-6">
						    	<p class="form-control-static"><?=utf8_encode($value[6])?></p>

						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-4">Code Postal</label>
						    <div class="col-sm-6">
						    	<p class="form-control-static"><?=$value[7]?></p>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-4">Ville</label>
						    <div class="col-sm-6">
						    	<p class="form-control-static"><?=utf8_encode($value[8])?></p>
						    </div>
						</div>
					</div> 
					<div class="form-group">
					    <label class="control-label col-sm-4">Date prévue</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"><?=$date_rdv?></p>

					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-4">Heure prévue*</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"><?=$hour?></p>

					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-4">Description*</label>
					    <div class="col-sm-6">
					    	<p class="form-control-static"><?=utf8_encode($value[5])?></p>

					    </div>
					</div>


					<p>* : champs obligatoires</p>
				</form>
			</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Fermer</button>
		</div>

				

		</div>
	</div>
</div>
<?php
	} //FIN DU FOREACH
?>
<div id="arrayEvent" class="table-responsive"></div>

<!-- CHARGE LA POPUP -->
	<script  onload="loadPage('addEvent.php', 'headerFormEvent')" type="text/javascript" src="js/script.js"></script>
	<script  onload="loadPage('arrayEvent.php', 'arrayEvent')" type="text/javascript" src="js/script.js"></script>
<?php

include "footer.php";

?>