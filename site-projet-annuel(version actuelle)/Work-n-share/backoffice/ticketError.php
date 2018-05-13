
<?php
session_start();
require "class/ticketClass.php";
$ticket = new Ticket();

if(isset($_POST['subject']) && isset($_POST['designation']) && isset($_POST['description'])){

	$error = $ticket->isEmpty($_POST['subject'], 1);
	$error2 = $ticket->isEmpty($_POST['designation'], 3);
	$error3 = $ticket->isEmpty($_POST['description'], 2);

	if(!$error && !$error2 && !$error3){
		if(isset($_SESSION['error'])){
			unset($_SESSION['error']);

		}
		//AJOUT TICKET
		$ticket->addTicket($_POST['subject'], "Exemple de personne", $_POST['description']);
		
	}
}

if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo '<div id="errors" class="alert alert-danger"><ul">';
	foreach ($_SESSION['error'] as $value) {
			
		echo '<li><span class="glyphicon glyphicon-remove-sign"></span>'.$value.'</li>';

	}
	echo '</ul></div>';

}

if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	echo '<div id="success"></div>';

}

?>



