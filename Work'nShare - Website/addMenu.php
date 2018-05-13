<?php
session_start();
require "class/menuClass.php";
$menu = new Menu();
$count = $menu->countMenu();

if(

	isset($_POST['namemenu']) &&
	isset($_POST['startermenu']) &&
	isset($_POST['dishmenu']) &&
	isset($_POST['dessertmenu']) &&
	isset($_POST['quantitymenu']) &&
	isset($_POST['checkedmenu'])
){

	$isError1 = false;
	$isError2 = false;
	$isError3 = false;
	$isError4 = false;
	$isError5 = false;
	$isError6 = false;



	$nameMenu = $_POST['namemenu'];
	$starterMenu = $_POST['startermenu'];
	$dishMenu = $_POST['dishmenu'];
	$dessertMenu = $_POST['dessertmenu'];
	$quantityMenu = $_POST['quantitymenu'];

	$checkedValue = $_POST['checkedmenu'];

	$isError1 = $menu->checkValueLength(5, 50, $nameMenu, 1);
	$isError2 = $menu->ifExist($nameMenu);
	$isError3 = $menu->checkValueLength(5, 50, $starterMenu, 2);
	$isError4 = $isError2 = $menu->checkValueLength(5, 50, $dishMenu, 3);
	$isError5 = $menu->checkValueLength(5, 50, $dessertMenu, 4);
	$isError6 = $menu->checkQuantityValue($quantityMenu, 5);
	

	if(	$isError1 == false &&
		$isError2 == false &&
		$isError3 == false &&
		$isError4 == false &&
		$isError5 == false &&
		$isError6 == false

		){
		if(isset($_SESSION['error'])){
			unset($_SESSION['error']);

		}
		$menu->addMenu($nameMenu, $starterMenu, $dishMenu, $dessertMenu, $quantityMenu, $checkedValue);
		
	}

	
}

if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo '<div id="errors" class="alert alert-danger"><ul">';
	foreach ($_SESSION['error'] as $value) {
			
		echo '<li><span class="glyphicon glyphicon-remove-sign"></span>'.$value.'</li>';

	}
	echo '</ul></div>';

}
?>

			
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h3 class="modal-title">Ajouter un menu</h3>

	
			

