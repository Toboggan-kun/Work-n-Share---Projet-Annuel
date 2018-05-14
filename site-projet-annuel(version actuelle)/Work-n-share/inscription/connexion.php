<?php
session_start();
ini_set("display_errors",0);

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');
	if(!empty($_POST['emailUser']) AND !empty($_POST['passwordUser']))
	{
		$emailUser = htmlspecialchars($_POST['emailUser']);
		$passwordUser = sha1($_POST['passwordUser']);

		$requser = $bdd->prepare("SELECT * FROM user WHERE emailUser = ? AND passwordUser = ?");
		$requser->execute([$emailUser, $passwordUser]);
		$result = $requser->fetch(PDO::FETCH_ASSOC);
		$userexist = $requser->rowCount();
		if($userexist == 1)
	{
		$_SESSION['id'] = $result['idUser'];
		$_SESSION['email'] = $result['emailUser'];
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
				<input type="text" name="emailUser" placeholder="Mail">
						</td>
					</tr>
					<tr>
						<td align="center">
				<input type="password" name="passwordUser" placeholder="Mot de passe">
						</td>
					</tr>
					<tr>
						<td align="center">
				<button type="submit">Se connecter</button>
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