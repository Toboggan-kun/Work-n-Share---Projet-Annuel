<?php

class Window{

	public $optionMessage;
	public $message;

	public function createBox($message, $idDiv, $function){ //CORPS DE LA FENETRE: MESSAGES D'ALERTES, DE CONFIRMATION, D'ERREURS
		$this->message = $message;

		return
				"<section id=". $idDiv. " class ='background'>
		            <div id='window'>
		                <h2>Attention</h2>
		                
		                	<p>" . $this->message . "</p>
		                	<input type='button' id='close' value='Annuler' onclick='closePopup(".$idDiv.")'></input>
		                	<input type='button' id='close' value='Confirmer' onclick='".$function."'></input>

		           
		            </div>
		        </section>";
	}

	public function errorBox($myMessage, $optionMessage){
		$this->message = $myMessage;
		$this->optionMessage = $optionMessage;

		return
				"<section id ='background'>
		            <div id='window'>
		                <h2>Erreur</h2>
		                
		                	<p>" . $this->message . "</p>
		                	<input type='button' id='close' value='Fermer' onclick='closePopup()'></input>
		                	

		           
		            </div>
		        </section>";
	}

	public function confirmAction($message, $idDiv, $function){

		return
		'<div class="modal fade" id='.$idDiv.' role="dialog">
			<div class="modal-dialog">


				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Attention</h3>
							
					</div>
					<div class="modal-body">
						<h4>' . $message .'</h4>
						<p>Ce choix ne pourra plus être contesté</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="'.$function.'">Confirmer</button>
					</div>
				</div>
			</div>
		</div>';

	}
	public function suspendUser($idDiv, $function){
		return '<div class="modal fade" id='.$idDiv.'>
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Suspendre l\'utilisateur '.$idDiv.'</h3>
							</div>
								<div class="modal-body">
				    				<form class="form-horizontal">
				                	
										<p>Veuillez indiquer le motif de la suspension</p>
					                	<select>
					                		<option></option>
					                		<option>Propos injurieux</option>
					                		<option>Dégradation du matériel important</option>
					                		<option>Paiement non survenu</option>
			
					                	</select>
					               	</form>
					            </div>
			                	<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="'.$function.'">Valider</button>
								</div>
									
								
				           		
				        </div>
				        
				    </div>';
	}
	

	public function createMiniatureEventBox($title, $description){
		return 
			'
			<div id="miniatureEvent">

				<li>
					<div id="imageEvent">
						<img src="">
					</div>
					<h3>'. $title . '</h3>
					<p>' . $description .  '</p>
					</div>
				</li>
			</div>

			';
	}

	public function createMiniatureRoomBox($title, $description, $id){
		return 
			'
			<div id="miniatureRoom">

				<button type="button" id="typeRoom'.$id.'" onclick="getTypeRoom('.$id.')" class="btn-default" value="'.$id.'">
				<li>
					<div id="">
						<img src="">
					</div>
					<h3>'. $title . '</h3>
					<p>' . $description .  '</p>
					</div>
				</li></button>
			</div>

			';
	}

	

	public function consultUser($id, $name, $surname, $phone, $mail, $sub, $state, $booking){
		return '

				<div class="modal fade" role="dialog" id="'.$id.'">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title">Aperçu du profil de '.$name.' '.$surname.'</h2>
							</div>

							<div class="modal-body">
								<h3>Membre Work\'n Share depuis le</h3>
								<h3>Identité</h3>
								<label>Nom</label>
								<p>'.$surname.'</p>
								<label>Prénom</label>
								<p>'.$name.'</p>

								<h3>Moyens de contact</h3>
								<label>Adresse mail</label>
								<p>'.$mail.'</p>
								<label>Téléphone</label>
								
								<label>Prénom</label>
								<p>'.$name.'</p>

								<h3>Adresse postale</h3>
								<p>[Adresse]</p>
								<p>[Code postal]</p>
								<p>[Ville]</p>
								<h3>Réservation</h3>
								<p>Pas de réservation</p>
								<h3>Abonnement</h3>
								<p>Abonnement n°'.$sub.'</p>
								<label>Validité</label>
								<p>Expire dans x jours</p>
							</div>

							        		
					    	<div class="modal-footer">
								<button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>

							</div>
						</div>
					</div>
				</div>';
				        
	}

	public function consultEvent($id){
		return '
		<div class="modal fade" id="consultEvent'.$id.'" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Fiche de l\'évènement</h2>
				</div>

				<div class="modal-content">
				<!-- CHARGE LES MESSAGES D\'ERREURS -->
					<div id="headerFormEvent" class="modal-header">
						
					</div>
					<br><br>
					<div class="modal-body">
						
						<form class="form-horizontal">
							<div class="form-group" >
							    <label class="control-label col-sm-4">Titre de l\'évenement* </label>
							    <div class="col-sm-6">
							    	<input type="text" class="form-control input-lg" id="titleEvent" placeholder="Entrez un titre" maxlength="100">
							    	<small>Donnez un simple titre accrocheur !</small>
							    </div>

							</div>
							<div class="form-group" >
							    <label class="control-label col-sm-4">Lieu de rencontre* </label>
							    <div class="col-sm-6">
							    	<select id="os" class="form-control input-lg">
							    		<option>Sélectionnez un lieu</option>
							    		<?php
							    			foreach ($openspace as $value) {
							    				echo "<option></option>";
							    			}
							    		?>
							    	</select>
							    </div>

							</div>

							<div class="form-group" onchange="displayAddressForm()">
							    <label class="control-label col-sm-4">Ou spécifier un autre lieu?</label>
							    <div class="radio">
								  <label class="radio-inline"><input type="radio" name="optradio" id="noEvent" checked="checked">Non</label>
								   <label class="radio-inline"><input type="radio" name="optradio" >Oui</label>
								</div>
							</div>
							<div id="hidden"> <!-- BALISE CACHEE -->
								<div class="form-group">
								    <label class="control-label col-sm-4">Adresse*</label>
								    <div class="col-sm-6">
								    	<input type="text" class="form-control input-lg" id="addressEvent" placeholder="Entrez l\'adresse" readonly="readonly" maxlength="100">
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
							    	<input type="date" class="form-control input-lg" id="dateEvent" min="<?=$_SESSION["currentDateEN"]?>" required="required">

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
		'

		;
	}




}
