<?php

require "class/userClass.php";

$user = new User();
$price = 0;
?>
<div class="col-sm-5" id="price_total">
	<div class="well well-lg">
		<h3>Votre demande</h3>
		<hr>
		<?php
			if(isset($_POST['subscription']) && isset($_POST['engagement'])){
				$subInfo = $user->loadSubscription($_POST['subscription']);

				foreach ($subInfo as $value) {
					
				}
				echo '<h4>'.$_POST['subscription'].'</h4>';
				if($_POST['engagement'] == 0){
					echo '<h5>Sans engagement<h5>';
					$price += $value[5];
				}else{
					echo '<h5>Avec engagement</h5>';
					$price += $value[4];
				}
			}
		?>
		<div class="col-sm-6">
			<h4><b>Total</b></h4>
		</div>
		<div class="col-sm-6">
			<h4><b><?=$price?>€</b></h4>
		</div>
		
	</div>
</div>
<div id="nextPage" class="col-sm-6" style="display: none;">
	<ul class="pager">
	<li><a onclick="nextPageSubscription()"><i class="fas fa-credit-card"></i> Je valide et je passe à l'étape suivante</a></li>
	</ul> 	
</div>
