
<?php 
include "header.php";
require "class/ticketClass.php";
$states = array("En attente de traitement", "En cours de traitement", "En retard", "Terminé");

if(isset($_GET['id_ticket'])){
	$ticketMessage = new Ticket();
	$id_ticket = $_GET['id_ticket'];

	$state_string = $ticketMessage->getTicketState($id_ticket);
	$state = intval($state_string[0]['state']);
	/*if(is_int($state_string)){
		$state = $states[$state_string];
	}*/
	$state_number = $ticketMessage->loadStateTicket();

	$ticketDataMsg = $ticketMessage->loadTicketMessage($id_ticket);
	if(empty($ticketDataMsg)){
		echo '<h1>Ce ticket n\'existe pas</h1>';
		die();
	}
	

	$date = date("d-m-Y", strtotime($ticketDataMsg[0]['date_post']));
    $hour = date("H:i", strtotime($ticketDataMsg[0]['date_post']));

    if(isset($_POST['state_ticket']) && isset($_POST['id'])){
    	$changeStateTicket = new Ticket();

    	switch ($_POST['state_ticket']){
		    case 'En attente de traitement':
		      $state = 0;
		      $changeStateTicket->updateStateTicket($_POST['id'], $state);
		      break;
		    case 'En cours de traitement':

		      $state = 1;
		      $changeStateTicket->updateStateTicket($_POST['id'], $state);
		      break;
		    case 'En retard':
		      $state = 2;
		      $changeStateTicket->updateStateTicket($_POST['id'], $state);
		      break;
		    case 'Terminé':
		      $state = 3;
		      $changeStateTicket->updateStateTicket($_POST['id'], $state);
		      break;
		 }
    	
    }

?>
<div id="infoTicket">
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#dataTicket">Informations détaillées</a></li>
  <li><a data-toggle="tab" href="#messageTicket">Messages</a></li>
</ul>

<div class="tab-content">
	<div id="dataTicket" class="tab-pane fade in active">
		<div class="well well-lg"><h3>Ticket n°<?=$id_ticket?> <?=$states[$state]?></h3></div>
		<?php
			if(isset($_SESSION['success'])){
				echo '	<div class="alert alert-success">
						  <b>'.$_SESSION['success'][0].'<b>
						</div>';
			}

		?>
		 <div class="list-group" style="width: 70%">
		 	<p class="list-group-item">Ce ticket a été créé le <?=$date?> à <?=$hour?></p>
			<p class="list-group-item">Par <?=$ticketDataMsg[0]['author']?></p>
			<p class="list-group-item">Concernant l'équipement </p>
			<p class="list-group-item"></p>
		</div>
		<div class="panel-group" id="accordion" style="width: 70%">
		  	<div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#updateTicket">
			        Modifier</a>
			      </h4>
			    </div>
			    <div id="updateTicket" class="panel-collapse collapse in">
				    
					<select class="form-control" id="stateTicket">
						<?php
						for ($i = 0; $i < 4; $i++) { 
							echo '<option>'.$states[$i].'</option>';
						}
						?>
						
					</select>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateTicketModal">Modifier l'état du ticket</button>
					<div id="updateTicketModal" class="modal fade" role="dialog">
					  	<div class="modal-dialog">

						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Confirmation</h4>
						      </div>
						      <div class="modal-body">
						        <p>Etes-vous sûr de modifier l'état du ticket ?</p>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="changeStateTicket('<?=$id_ticket?>')">Valider</button>
						      </div>
						    </div>

						  	</div>
					</div>

			
			    </div>
		  	</div>
		</div>
  	</div>
  	<div id="messageTicket" class="tab-pane fade">
  		
	</div>
	<script type="text/javascript" src="js/script.js" onload="loadPage('ticketDataMessage.php?id_ticket=<?=$id_ticket?>', 'messageTicket')"></script>
</div>
</div>


<?php

}else{
	echo "Une erreur est survenue";
}

?>