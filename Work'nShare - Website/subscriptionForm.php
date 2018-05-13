<?php

include "header.php";
require "class/userClass.php";

$user = new User();

$user_data = $user->laodUserById(1);
$subscription = $user->convertIntSubtoString($user_data[0]['subscription']);

?>
<div class="page-header">
  <h2>Souscrivez à un abonnement Work'n Share</h2>
</div>

<div class="well well-lg"><h3>Vous possedez actuellement l'abonnement : <b><?=$subscription?></b></h3></div>
<div id="page2_payment" class="col-sm-12" style="display: none"></div>
	<div class="col-sm-7">
	<div id="sub_part1" class="well well-lg" onchange="getSubscription()">
		<h3><b>Choisir un nouvel abonnement</b></h3>
		<?php
			if($user_data[0]['subscription'] == 0){
				echo '<label class="radio-inline"><input id="abo1" type="radio" name="optradio" value="Abonnement simple">Abonnement simple</label>
				<label class="radio-inline"><input type="radio" id="abo2" name="optradio" value="Abonnement résident">Abonnement résident</label>';
			}
		?>
		<hr>
		<div id="sub_part2">
		</div>
		
		
		
	</div>
	
</div>	
<div id="sub_part3"></div>
<script type="text/javascript" src="js/script.js" onload="loadPage('subscriptionFormPart2.php', 'sub_part2')"></script>
<script type="text/javascript" src="js/script.js" onload="loadPage('subscriptionFormPart3.php', 'sub_part3')"></script>
<script type="text/javascript" src="js/script.js" onload="loadPage('paymentFormSubscription.php', 'page2_payment')"></script>