<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
	$getid = intval($_GET['id']);
	$requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
?>

<html>
	<head>
		<title>Profil</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="profil.css"/>
	</head>
	<body>
		<div align="center">
			<br/>
			<h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
			<br /><br />
			Pseudo = <?php echo $userinfo['pseudo']; ?>
			<br/>
			Mail = <?php echo $userinfo['mail']; ?>
			<br/>
			Abonnement = ...
			<br/><br/><br/><br/><br/><br/>
			Prochaine réservation = ...
			<br/>
			Heures choisies = ...
			<br/>
			Localisation = ...
			<br/>
			Type de salle choisie = ...
			<br/>
			Prix de la réservation = ...
			<?php
			if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
			{
			?>
			<br/><br/><br/><br/>
			<a href="editionprofil.php"> Editer mon profil</a>
			<a href="deconnexion.php"> Se déconnecter</a>
			<a href="../index.php"> Retourner au menu</a>
			<?php
			}
			?>
		</div>
	</body>
</html>

<?php 
}
?>