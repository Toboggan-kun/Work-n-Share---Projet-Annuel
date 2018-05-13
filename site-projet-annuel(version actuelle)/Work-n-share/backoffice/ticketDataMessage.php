<?php

require "class/ticketClass.php";
$ticketMessage = new Ticket();


?>
<div class="well well-lg"><h3>Messages</h3></div>
	<div class="container" id="loadMsg">
	<hr>
	<?php
		if(isset($_GET['id_ticket'])){

			$id_ticket = $_GET['id_ticket'];
			$ticketDataMsg = $ticketMessage->loadTicketMessage($id_ticket);

			if(isset($_POST['message_ticket'])){
				$error = $ticketMessage->isEmpty($_POST['message_ticket'], 5);

				if(!$error){
					if(isset($_SESSION["error"]) && !empty($_SESSION['error'])) {
						session_unset($_SESSION['error']);
					}
					$ticketMessage->addAnswer($id_ticket, $_POST['message_ticket'], "Caroline");
				}
			}
			
			foreach ($ticketDataMsg as $value) {
				$date = date("d-m-Y", strtotime($value[2]));
				$hour = date("H:i", strtotime($value[2]));
				echo '<div class="media fade in">
						<div class="media-left">
						  	<img src="image/avatar.png" class="media-object" style="width:60px">
							<h5 class="media-heading">Par <b>'.$value[4].'</b> le <b>'.$date.'</b> à <b>'.$hour.'</b></h5>
						</div>
						<div class="media-body">
							<p style="float: left">'.$value[3].'</p>
						</div>
					</div>
					<hr>';
			}
		}
		if(isset($_SESSION['error'])){
			echo '	<div class="alert alert-danger" id="errors">
					  <b>'.$_SESSION['error'][0].'<b>
					</div>';
		}
	?>



	<div class="well well-lg">
		<h3>Ecrire un message</h3>
	<form class="form-horizontal" action="">
		<div class="form-group">
		    <div class="">
		    	<textarea class="form-control" rows="10" placeholder="Entrez votre message" id="sendMessage" style="width: 65%" maxlength="254"></textarea>
		    </div>
		    
	  	</div>
	  	<button type="button" class="btn btn-success btn-lg" onclick="sendTicketMessage('<?=$id_ticket?>')">Envoyer</button>
	</form>
	</div>
</div>