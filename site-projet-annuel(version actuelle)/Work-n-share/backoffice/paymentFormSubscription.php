<?php

require "class/userClass.php";

$user = new User();
$user_data = $user->laodUserById(1);
foreach ($user_data as $value) {

}
if(isset($_POST['subscription']) && isset($_POST['engagement']) && isset($_POST['id_card']) && isset($_POST['security_card']) && isset($_POST['card_month']) && isset($_POST['card_year'])){
	$error1 = $user->checkCardNumber(trim($_POST['id_card']));
	$error2 = $user->checkCardSecurity(trim($_POST['security_card']));
	$error3 = $user->checkCardMonth(trim($_POST['card_month']), trim($_POST['card_year']));
	$error4 = $user->checkCardYear(trim($_POST['card_year']));

	if(!$error1 && !$error2 && !$error3 && !$error4){
		if(isset($_SESSION['error'])){
			unset($_SESSION['error']);

		}
	}
}
?>

<div id="paymentFormSub" class="container col-sm-12">

	<div class="col-sm-12">
		<div class="well well-lg">
			<h3>Vous êtes</h3>
			<hr>
			<br>
			<label class="col-sm-6">Nom</label>
			<p class="col-sm-6"><?=$value[1]?></p>
			<label class="col-sm-6">Prénom</label>
			<p class="col-sm-6"><?=$value[2]?></p>
			<br>
			<br>
		</div>
	</div>
	<div class="col-sm-12">

	<div class="page-header">
  		<h2>Enregistrer vos coordonnées bancaires</h2>

	</div>
	<?php
	
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		echo '<div class="alert alert-danger"><ul">';
		foreach ($_SESSION['error'] as $value) {
				
			echo '<li><span class="glyphicon glyphicon-remove-sign"></span>'.$value.'</li>';

		}
		echo '</ul></div>';

	}
	?>

	<div class="alert alert-info">
	  	<strong>Paiement en ligne</strong><br>
	  	
	</div>
	<div class="well">Merci de renseigner vos informations bancaires pour confimrer votre choix d'abonnement</div>
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
	</div>

	<button class="btn btn-success btn-lg" onclick="validSubscription()">Valider</button>
</div>	