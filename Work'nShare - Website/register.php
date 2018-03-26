<?php

session_start();
require "class/dataBaseClass.php";
include "header.php";

	//CONNEXION A LA BASE DE DONNEES
	$bdd = connectBDD();

	if(isset($_POST) && !empty($_POST)){
		if(    !empty($_POST["user_name"]
			&& !empty($_POST["email"])
			&& !empty($_POST["password"])
			&& !empty($_POST["password2"]))
		){
			$user = $bdd->prepare("SELECT * FROM user WHERE user_name = :user_name, user_mail = :user_mail, user_password = :user_password");
			$user->execute([
					"user_name" => $_POST["user_name"],
					"user_mail" => $_POST["email"],
					"user_password" => $_POST["password"]
				]);

			$user_name = trim($_POST["user_name"]);
			$email = trim($_POST["email"]);
			$password = trim($_POST["password"]);
			$password2 = trim($_POST["password2"]);
			$date_register = date("Y-m-d H:i:s");

			$user->fetch();
			

			//VERIFIER SI LE PSEUDO EXISTE DEJA
			$query = $bdd->prepare("SELECT * FROM user WHERE user_name = :user_name");
			$query->execute([
					"user_name" => $user_name
				]);
			if(empty($query->fetch())){
				//VERIFIER SI L'EMAIL EST VALIDE
				if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
					//VERIFIER SI L'EMAIL EXISTE DEJA
					$query2 = $bdd->prepare("SELECT user_mail FROM user WHERE user_mail = :user_mail");
					$query2->execute([
						"user_mail" => $email
						]);
					if(empty($query2->fetch())){
						//VERIFIER SI LES DEUX MOTS DE PASSES SONT IDENTIQUES
						if($password == $password2){
							$password = sha1($password, PASSWORD_DEFAULT);

							$_SESSION["user"] = $user_name;

							$insert = $bdd->prepare("INSERT INTO user(user_name, user_mail, user_pwd, date_register) VALUES('$user_name', '$email', '$password', $date_register')");
							$insert->execute(array(
									$user_name,
									$email,
									$password,
									$date_register
								));
							header ("Location: index.php");

						}else{
							$error = "Les mots de passe de correspondent pas";
						}
					}else{
						$error = "Cet email existe déjà";
					}
				}else{
					
					$error = "Votre email est incorrect";
				}
			}else{
				$error = "Ce pseudo troll existe déjà";
			}
			
		}
	}

?>

<!-- PAGE D'INSCRIPTION -->
<!DOCTYPE <html>
<head>
	<meta charset="utf-8">
	<title>Troll Me Again</title>
</head>
<body>
	<br><br><br><br><br><br>
	<h1>TrollMeAgain - Inscription</h1>
	<!-- FORMULAIRE D'INSCRIPTION -->
	<br><br><br><br>
	<form method="POST" action="register.php">
		<br>
		<input type="text" name="user_name" placeholder="Pseudo troll" required="required">
		<br>		
		<input type="text" name="email" placeholder="Email" required="required">
		<br>
		<input type="password" name="password" placeholder="Entrez votre mot de passe" required="required">
		<br>
		<input type="password" name="password2" placeholder="Confirmez votre mot de passe" required="required">
		<br><br>
		<input type="submit" name="submit" value="Envoyer">
		<br><br><br>
		<?php

			//AFFICHAGE DES ERREURS
			if(isset($error)){
				echo $error;
			}
		?>
	</form>
</body>
</html>

