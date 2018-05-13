<?php
require_once "conf.inc.php";
require "class/roomClass.php";
$room = new Room();
echo '<script>console.log("ok");</script>';
if(isset($_POST['addRoom'])){

	$nameRoom = $_POST['addRoom'];
	$array = explode('|', $nameRoom);
	$room->roomExist($array[2]);
	$room->isEmpty($array[0], 2);
	$room->isEmpty($array[1], 3);
	$room->checkValueLength(5, 20, $array[2], 4);
	
	//MESSAGES
	if(isset($_SESSION['error']) && count($_SESSION['error']) == 0){
		$room->addRoom($array[0], $array[1], $array[2]);
		//unset($_SESSION['error']);

	}

}
if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo '<div id="errors" class="alert alert-danger"><ul">';
	foreach ($_SESSION['error'] as $value) {
			
		echo '<li><span class="glyphicon glyphicon-remove-sign"></span>'.$value.'</li>';

		
	}
	print_r($_SESSION['error']);
	/*var_dump($_SESSION['error']);
	echo $_SESSION['error'];*/
	echo '</ul></div>';
	//unset($_SESSION['error']);
}

echo '<script>console.log(\'"test"\'); alert();</script>';

?>
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Créer une salle</h2>