<?php
session_start();
ini_set("display_errors",0);

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');

	$idUser = htmlspecialchars($_POST['idUser']);
	$nameUser = htmlspecialchars($_POST['nameUser']);
	$surnameUser = htmlspecialchars($_POST['surnameUser']);
	$emailUser = htmlspecialchars($_POST['emailUser']);
	$passwordUser = sha1($_POST['passwordUser']);
	$addressUser = htmlspecialchars($_POST['addressUser']);
	$postalCodeUser = htmlspecialchars($_POST['postalCodeUser']);
	$cityUser = htmlspecialchars($_POST['cityUser']);
	$mdp2 = sha1($_POST['mdp2']);
	$subscription = '0';
	$subscriptionDate = '0';
	$isAdmin = '0';
	$token = '0';
	$isDeleted = '0';
	$idCard = '0';

	if(!empty($_POST['nameUser']) AND !empty($_POST['surnameUser']) AND !empty($_POST['emailUser']) AND !empty($_POST['passwordUser']) AND !empty($_POST['mdp2'])) 
	{
		$namelength = strlen($nameUser);
		$surnamelength = strlen($surnameUser);
		if($namelength >= 2)
		{
			if($surnamelength >= 2)
			{
				if(filter_var($emailUser, FILTER_VALIDATE_EMAIL))
				{
					$reqmail = $bdd->prepare("SELECT * FROM user WHERE emailUser = ?");
					$reqmail->execute(array($emailUser));
					$mailexist = $reqmail->rowCount();
					if($mailexist == 0)
					{
						if($passwordUser == $mdp2)
						{
							$insertmbr = $bdd->prepare("INSERT INTO user(nameUser, surnameUser, emailUser, passwordUser, addressUser, postalCodeUser, cityUser, subscription, subscriptionDate, isAdmin, token, isDeleted, idCard) VALUES(:nameUser, :surnameUser, :emailUser, :passwordUser, :addressUser, :postalCodeUser, :cityUser, :subscription, :subscriptionDate, :isAdmin, :token, :isDeleted, :idCard)");

							$insertmbr->execute(["nameUser" => $nameUser, 
							"surnameUser" => $surnameUser,
							"emailUser" => $emailUser,
							"passwordUser" => $passwordUser,
							"addressUser" => $addressUser,
							"postalCodeUser" => $postalCodeUser,
							"cityUser" => $cityUser,
							"subscription" => $subscription,
							"subscriptionDate" => $subscriptionDate,
							"isAdmin" => $isAdmin,
							"token" => $token,
							"isDeleted" => $isDeleted,
							"idCard" => $idCard
							]);
							$erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\"> Me connecter </a>";
						}
						else
						{
							$erreur = "Vos mots de passes ne correspondent pas !";
						}
					}
					else
					{
						$erreur = "Adresse mail déjà utilisée !";
					}
				}
				else
				{
					$erreur = "Votre adresse mail n'est pas valide !";
				}
			}
			else
			{
				$erreur = "Un nom de moins de 3 lettres..?";
			}
		}
		else
		{
			$erreur = "Un prénom de moins de 3 lettres..?";
		}
	}
	else
	{
		$erreur = "Tous les champs doivent être complétés !";
	}

?>
<html>
	<head>
		<title>TUTO PHP</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="inscription.css"/>
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	</head>
	<header>
	</header>
	<body>
		<div align="center">
			<h2>Inscription</h2>
			<table>
				<tr>
						<td align="right">
							Vous avez déjà un compte? <a href="connexion.php">Se connecter
						</td>
					</tr>
					<tr>
						<td align="center">
							<a href="../index.php">Retourner au menu
						</td>
					</tr>
			</table>
			<br />

			<form method="POST" action="">
				<table>
					<tr>
						<td align="right">
							<label for="nameUser">Prenom :</label>
						</td>
						<td>
							<input type="text" placeholder="Votre prenom" id="nameUser" name="nameUser" value="<?php if(isset($nameUser)) { echo $nameUser; } ?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="surnameUser">Nom :</label>
						</td>
						<td>
							<input type="text" placeholder="Votre nom" id="surnameUser" name="surnameUser" value="<?php if(isset($surnameUser)) { echo $surnameUser; } ?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="emailUser">Mail :</label>
						</td>
						<td>
							<input type="email" placeholder="Votre mail" id="emailUser" name="emailUser" value="<?php if(isset($emailUser)) { echo $emailUser; } ?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="passwordUser">Mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Votre mot de passe" id="passwordUser" name="passwordUser" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp2">Confirmation du mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Confirmez votre mdp" id="passwordUser2" name="mdp2" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="addressUser">Veuillez entrer votre adresse :</label>
						</td>
						<td>
							<input type="text" placeholder="Veuillez entrer votre adresse" id="addressUser" name="addressUser" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="postalCodeUser">Veuillez entrer votre code postal :</label>
						</td>
						<td>
							<input type="text" placeholder="Veuillez entrer votre code postal" id="postalCodeUser" name="postalCodeUser" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="cityUser">Veuillez entrer votre ville :</label>
						</td>
						<td>
							<input type="text" placeholder="Veuillez entrer votre ville" id="cityUser" name="cityUser" />
						</td>
					</tr>
					<tr>
				</table>
				<table>
						<td></td>
						<td align="center">
							<br />
							<button type="submit">Je m'inscris</button>
						</td>
					</tr>
				</table>
			</form>
			<?php
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur."</font>";
			}
			?>
		</div>
	</body>
</html>