<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');

if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM user WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE users SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }



   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE users SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }

   if(isset($_POST['newpassword']) AND !empty($_POST['newpassword
      ']) AND $_POST['newpassword'] != $user['passwordUser']) {
      $newpassword = sha1($_POST['newpassword']);
      $insertpassword = $bdd->prepare("UPDATE user SET passwordUser = ? WHERE idUser = ?");
      $insertmail->execute(array($newpassword, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }




   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE users SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="edition.css"/>
   </head>
   <body>
      <div align="center">
         <h2>Edition de mon profil</h2>
         <table>
            <tr>
                  <td align="center">
                     <a href="../index.php">Retourner au menu
                  </td>
               </tr>
         </table>
         <br/>

            <form method="POST" action="">
               <table>
                  <tr>
                     <td align="right">
                        <label for="mail">Mail :</label>
                     </td>
                     <td>
                        <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" />
                     </td>
                  </tr>
                  <tr>
                     <td align="right">
                        <label for="mdp">Mot de passe :</label>
                     </td>
                     <td>
                        <input type="password" name="newmdp1" placeholder="Mot de passe"/><br />
                     </td>
                  </tr>
                  <tr>
                     <td align="right">
                        <label for="mdp2">Confirmation - mot de passe :</label>
                     </td>
                     <td>
                        <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" />
                     </td>
                  </tr>
                  <tr>
               </table>
               <table>
                     <td></td>
                     <td align="center">
                           <br/>
                           <input type="submit" value="Mettre à jour mon profil" />
                        </td>
                     </tr>
                  </table>
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
<?php   
}
else {
   header("Location: connexion.php");
}
?>