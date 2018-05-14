<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
	$getid = intval($_GET['id']);
	$requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
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
			<h2>Profil de <?php echo $userinfo['nameUser']; ?></h2>
			<br /><br />
			Nom = <?php echo $userinfo['surnameUser']; ?>
			<br/>
			Mail = <?php echo $userinfo['emailUser']; ?>
			<br/>
			Adresse = <?php echo $userinfo['addressUser']; ?>
			<br/>
			Code postal = <?php echo $userinfo['postalCodeUser']; ?>
			<br/>
			Ville = <?php echo $userinfo['cityUser']; ?>
			<br/><br/><br/><br/>
			<a href="editionprofil.php"> Editer mon profil</a>
			<a href="deconnexion.php"> Se déconnecter</a>
			<a href="../index.php"> Retourner au menu</a>
		</div>
	</body>
</html>

<?php 
}
?>