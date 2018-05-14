<?php


require_once "conf.inc.php";
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
	unset($_SESSION['error']);
}

?>
<div id="header">
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Work'n Share</title>
	<script type="text/javascript" src="js/script.js"></script>
	<link rel="stylesheet" href="style.css">
	<!-- BOOTSTRAP -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- ICONES -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>

</head>
<header>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Work'n Share</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
      <li><a href="events.php">Evenements </a></li>
		<li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="manageUsers.php"><i class="fas fa-users"></i> Utilisateurs 
	    <span class="caret"></span></a>
	    <ul class="dropdown-menu">
	      	<li><a href="manageUsers.php"><i class="fas fa-users"></i> Clients</a></li>
	    </ul>
	  	</li>
		<li><a href="menu.php"><i class="fas fa-utensils"></i> Menu </a></li>
		<li><a href="rooms.php"><i class="fas fa-calendar-alt"></i> Salles disponibles </a></li>
		<li><a href="openspace.php"><i class="fab fa-buromobelexperte"></i></i> Openspace </a></li>
		<li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="equipments.php"><i class="fas fa-laptop"></i> Equipements 
	    <span class="caret"></span></a>
	    <ul class="dropdown-menu">
	      	<li><a href="equipments.php"><i class="fas fa-laptop"></i> Equipements</a></li>
	      	<li><a href="tickets.php"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
	    </ul>
	  </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="userProfile.php"><i class="fas fa-user-circle"></i> Mon espace </a></li>
      <li><a href=""><i class="fas fa-power-off"></i></a></li>
    </ul>
  </div>
</nav>
</header>
<center>
<div id="mainTitle">

	<h1> Administration Work'n Share </h1>
</div>
<body>

<?php
	/*if(isset($_SESSION['errors'])){
		echo "<div id='displayErrorMessages'><ul>";
		foreach ($_SESSION["errors"] as $error) {
			echo "<li>".$error."</li>";
		}
		echo "</ul></div>";
	}else if(isset($_SESSION['success'])){
		echo "<div id='displaySuccessMessages'  onclick='clearTime()'><ul>";
		$msg = $_SESSION['success'];
		echo "<li>".$msg."</li>";
		echo "</ul></div>";
	}*/

?>

</div>
<div class="container-fluid">



