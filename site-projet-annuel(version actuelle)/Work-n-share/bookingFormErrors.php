<?php

require_once "class/bookingClass.php";
$booking = new Booking();

echo "<div id=\"errors\">";
if(	isset($_POST['openspace_booking']) &&
	isset($_POST['typeroom_booking']) &&
	isset($_POST['date_booking']) &&
	isset($_POST['hourentrance_booking']) &&
	isset($_POST['hourexit_booking']) &&
	isset($_POST['quantityequipment1_booking']) &&
	isset($_POST['quantityequipment2_booking']) &&
	isset($_POST['quantitymenu_booking']) &&
	isset($_POST['cardnumber_booking']) &&
	isset($_POST['cardsecurity_booking']) &&
	isset($_POST['cardmonth_booking']) &&
	isset($_POST['cardyear_booking'])
	){

	$error1 = false;
	$error2 = false;
	$error3 = false;
	$error4 = false;


	$error1 = $booking->checkCardNumber(trim($_POST['cardnumber_booking'])); //VERIFIE LA VALIDITE DU NUMERO DE CARTE
	$error2 = $booking->checkCardSecurity(trim($_POST['cardsecurity_booking']));
	$error3 = $booking->checkCardMonth(trim($_POST['cardmonth_booking']), trim($_POST['cardyear_booking']));
	$error4 = $booking->checkCardYear(trim($_POST['cardyear_booking']));

	if(!$error1 && !$error2 && !$error3 && !$error4){
		if(isset($_SESSION['error'])){
			unset($_SESSION['error']);

		}
		$hourentrance_booking = date("Y-m-d H:i", strtotime($_POST['date_booking'].$_POST['hourentrance_booking']));
		$hourexit_booking = date("Y-m-d	 H:i", strtotime($_POST['date_booking'].$_POST['hourexit_booking']));

		$booking->createBooking($_POST["openspace_booking"], $hourentrance_booking, $hourexit_booking, $_POST['quantityequipment1_booking'], $_POST['quantityequipment2_booking'], $_POST['quantitymenu_booking']);

	}
	


}

if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo '<div class="alert alert-danger"><ul">';
	foreach ($_SESSION['error'] as $value) {
			
		echo '<li><span class="glyphicon glyphicon-remove-sign"></span>'.$value.'</li>';

	}
	echo '</ul></div>';

}
?>