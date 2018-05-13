

	<?php

		if(isset($_POST['openspace_booking']) &&
			isset($_POST['typeroom_booking']) &&
			isset($_POST['date_booking']) &&
			isset($_POST['hourentrance_booking']) &&
			isset($_POST['hourexit_booking']) &&
			isset($_POST['quantityequipment1_booking']) &&
			isset($_POST['quantityequipment2_booking']) &&
			isset($_POST['quantitymenu_booking'])){
			echo '
			<div id="recapBooking" class="container" style="display: none;">
				<h2>Récapitulatif de votre demande</h2>
				
			  	<div class="page-header">
			  		<h2>Vous avez demandé</h2>
				</div>
				<table class="table-responsible">
				    <tbody>
				      <tr>
				      	<th>Lieu</th>
				        <td>'.$_POST['openspace_booking'].'</td>
				      </tr>
				      <tr>
				      	<th>Type de salle</th>
				      	';
				      	if($_POST['typeroom_booking'] == 1) echo '<td>Salle d\'Appels</td>';
				      	if($_POST['typeroom_booking'] == 2) echo '<td>Salle de Réunion</td>';
				      	if($_POST['typeroom_booking'] == 0) echo '<td>Salon Cosy</td>';

				        
				      echo '</tr>
				      <tr>
				      	<th>Date prévue</th>';

				      	$date_booking = date("d-m-Y", strtotime($_POST['date_booking']));
				        echo '<td>'.$date_booking.'</td>
				      </tr>
				      <tr>
				      	<th>Heure d\'arrivée</th>
				        <td>'.$_POST['hourentrance_booking'].'</td>
				      </tr>
				      <tr>
				      	<th>Heure de fin</th>
				        <td>'.$_POST['hourexit_booking'].'</td>
				      </tr>
				      <tr>
				      	<th>Options</th>
				        <td></td>
				      </tr>
				      <tr>
				      	<td></td>
				        <td>'.$_POST['quantityequipment1_booking']." multiprises à 4 entrées".'</td>
				      </tr>
				      <tr>
				      	<td></td>
				        <td>'.$_POST['quantityequipment2_booking']." ordinateurs portables".'</td>
				      </tr>
				      <tr>
				      	<td></td>';
				      	if($_POST['quantitymenu_booking'] != 0) echo
				        '<td>'.$_POST['quantitymenu_booking']." plateaux repas".'</td>';
				    	else echo
				        '<td>'.$_POST['quantitymenu_booking']." plateau repas".'</td>';
				      	
				      echo '</tr>
				     </tbody>
				</table>

			</div>';
			echo '
				<div id="paymentForm" class="container" style="display: none;">
					<div class="page-header">
				  		<h2>Enregistrer vos coordonnées bancaires</h2>

					</div>
					<div class="alert alert-info">
					  	<strong>Paiement en ligne</strong><br>Le paiement sera effectué à la fin de votre réservation
					  	<br>Annulation de votre réservation possible 24h avant votre arrivée
					</div>
					<div class="well">Merci de renseigner vos informations bancaires pour confimrer votre réservation</div>
					<form class="form-horizontal" action="">
						<div class="form-group">
							<label class="control-label col-sm-5">Numéro de carte*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control input-lg" id="idCard" placeholder="0000 0000 0000 0000" maxlength="16">
								</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-5" for="pwd">Code sécurité*</label>
							<div class="col-sm-2"> 
								<input type="password" maxlength="3" class="form-control input-lg" id="security_code" placeholder="000">
							</div>
						</div>
								
						<div class="form-group">
							<label class="control-label col-sm-5" for="pwd">Date d\'expiration*</label>
							<div class="col-sm-2">
							    <label><input type="text" id="card_month" maxlength="2" placeholder="MM" class="form-control input-lg"></label>
							</div>
							<div class="col-sm-3">
							    <label><input type="text" placeholder="AAAA" maxlength="4" class="form-control input-lg" id="card_year"></label>
							</div>
						</div>

						
					</form>
				</div>';?>
			<div id="confirmBooking" class="container" style="display: none;">
				<div id="errors_booking"></div>
                <ul class="pager">
                    <li class="previous"><a onclick="previousPage()">Retour en arrière</a></li>
                </ul>
                <button type="button" class="btn btn-primary btn-lg" onclick="addBooking()">Je confirme ma réservation</button>
                

            </div>
            

			
<?php
		}else{
			header("Location: booking.php");
		}

	?>




