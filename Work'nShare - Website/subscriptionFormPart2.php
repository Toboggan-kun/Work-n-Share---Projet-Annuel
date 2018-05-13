<?php

require "class/userClass.php";

$user = new User();

?>
<div id="sub_info" style="display: block;">
	<?php

		if(isset($_POST['sub'])){
			
			$subInfo = $user->loadSubscription($_POST['sub']);

			if(empty($subInfo)){
				echo '<div class="alert alert-danger">
					  <strong>Cet abonnement n\'existe pas !</strong>
					</div>';
				die();
			}

			foreach ($subInfo as $value) {
				
			}
		

	?>
	<div class="panel panel-primary">
		<div class="panel-heading">Tarifs</div>
			<div class="panel-body">
				<?php
				if($_POST['sub'] == "Abonnement simple"){
					echo '<li><i class="far fa-clock"></i> Première heure : <b>'.$value[2].'€</b>
				<li><i class="far fa-clock"></i> Demi-heure suivante : <b>'.$value[3].'€</b>
				<li><i class="far fa-clock"></i> 5 heures et plus : <b>'.$value[5].'€</b>';
				}else if($_POST['sub'] == "Abonnement résident"){
					echo 'Bénéficiez d\'un accès à tous les espaces en illimité 7/7j ! 
						<li> Devenez membre résident sans engagement : <b>'.$value[5].'€</b>';
				}
				

				?>
			</div>
		</div>
		<div class="panel panel-info">
		<?php
			if($_POST['sub'] == "Abonnement simple"){
				echo '<div class="panel-heading">Devenir membre sans engagement</div>
						<div class="panel-body">
							En devenant membre sans engagement, profitez d\'une offre de <b>'.$value[5].'€</b> par mois.
						</div>';
			}else if($_POST['sub'] == "Abonnement résident"){
				echo '<div class="panel-heading">Devenir membre sans engagement</div>
						<div class="panel-body">
							En devenant membre sans engagement, profitez d\'une offre de <b>'.$value[5].'€</b> par mois pour des accès en illimité.
						</div>';
			}

		?>
		<button type="button" id="noengagementChoice" onclick="changeStateSubscription('noengagementChoice')" class="btn btn-success btn-md">Je choisis cette offre !</button>
		</div>
		<div class="panel panel-info">
		<?php
			if($_POST['sub'] == "Abonnement simple"){
				echo '<div class="panel-heading">Devenir membre avec engagement 12 mois</div>
						<div class="panel-body">
							En devenant membre avec engagement 12 mois, profitez d\'une offre de <b>'.$value[4].'€</b> par mois.
						</div>';
			}else if($_POST['sub'] == "Abonnement résident"){
				echo '<div class="panel-heading">Devenir membre avec engagement 8 mois</div>
						<div class="panel-body">
							En devenant membre avec engagement 8 mois, profitez d\'une offre de <b>'.$value[4].'€</b> par mois pour des accès en illimité.
						</div>';
			}

		?>
		<button type="button" id="engagementChoice" onclick="changeStateSubscription('engagementChoice')" class="btn btn-success btn-md">Je choisis cette offre !</button>
		</div>
		<div class="panel panel-primary">
		<div class="panel-heading">Services inclus</div>
		<div class="panel-body">
			<?php
				if($_POST['sub'] == "Abonnement simple" || $_POST['sub'] == "Abonnement résident"){
					echo '<li><i class="fas fa-check"></i> Snacking et boissons à volonté
						<li><i class="fas fa-check"></i> Accès libre à tous les espaces
						<li><i class="fas fa-check"></i> Cabines téléphoniques
						<li><i class="fas fa-check"></i> Wifi haut-débit';
				}else if($_POST['sub'] == "Sans abonnement"){
					echo '<li><i class="fas fa-check"></i> Snacking et boissons à volonté
						<li><i class="fas fa-check"></i> Accès open space (sans possibilité de changer d\'adresse)
						<li><i class="fas fa-check"></i> Cabines téléphoniques
						<li><i class="fas fa-check"></i> Wifi haut-débit';
				}
			?>
			
		</div>
	</div>

	<?php
		}
	?>
</div>