<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');

if(isset($_POST['formconnexion']))

{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM users WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
	{
		$userinfo = $requser->fetch();
		$_SESSION['id'] = $userinfo['id'];
		$_SESSION['pseudo'] = $userinfo['pseudo'];
		$_SESSION['mail'] = $userinfo['mail'];
		header("Location: profil.php?id=".$_SESSION['id']);
	}
	else
	{
		$erreur = " Mauvais mail ou mot de passe ";
	}
}
else
{
	$erreur = " Tous les champs doivent être complétés !";
}

}

?>
<html>
	<head>
		<title>TUTO PHP</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="connexion.css"/>
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	</head>
	<body>
		<div align="center">
			<h2>Connexion</h2>
			<table>
					<tr>
						<td align="right">
							Pas de compte? <a href="inscription.php">S'inscrire
						</td>
					</tr>
					<tr>
						<td align="center">
							<a href="../index.php">Retourner au menu
						</td>
					</tr>
			</table>
			<form method="POST" action="">
				<table>
					<tr>
						<td align="center">
				<input type="text" name="mailconnect" placeholder="Mail">
						</td>
					</tr>
					<tr>
						<td align="center">
				<input type="password" name="mdpconnect" placeholder="Mot de passe">
						</td>
					</tr>
					<tr>
						<td align="center">
				<input type="submit" name="formconnexion" value="Se connecter">
						</td>
					</tr>
			</form>
			<?php
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur."</font>";
			}
			?>
		</div>
	</body>
</head>
</html>