<?php 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "Cet utilisateur et cet E-mail ne correspondent pas";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Veuillez vérifier vos mails <span>$email</span>"
        . " nous vous avons envoyé un lien de réinitialisation de mot de passe!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Lien de réinitialisation de votre mot de passe( clevertechie.com )';
        $message_body = '
        Bonjour '.$first_name.',

        Vous avez demandé un lien de réinitialisation de votre mot de passe

        Cliquez sur le lien ci-dessous afin de le réinitialiser:

        http://localhost/login-system/reset.php?email='.$email.'&hash='.$hash;  

        mail($to, $subject, $message_body);

        header("location: success.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    
  <div class="form">

    <h1>Réinitialisation du mot de passe</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Adresse E-mail<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Réinitialiser</button>
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
