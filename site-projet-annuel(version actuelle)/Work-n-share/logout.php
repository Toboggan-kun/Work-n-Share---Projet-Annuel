<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">
          <h1>Merci d'être passé!</h1>
              
          <p><?= 'Vous êtes bien déconnecté!'; ?></p>
          
          <a href="index.php"><button class="button button-block"/>Menu</button></a>

    </div>
</body>
</html>
