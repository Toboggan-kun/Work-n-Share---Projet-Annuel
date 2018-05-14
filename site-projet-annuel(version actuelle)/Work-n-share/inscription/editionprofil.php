<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=worknshare', 'root', '');
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM user WHERE idUser = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

   if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['nameUser']) {
      $newprenom = htmlspecialchars($_POST['newprenom']);
      var_dump($newprenom);
      $insertprenom = $bdd->prepare("UPDATE user SET nameUser = :nameUser WHERE idUser = :idUser");
      //$insertprenom->execute($newprenom, $_SESSION['id']);
      $insertprenom->execute(["nameUser" => $newprenom, 'idUser' => $_SESSION['id']]);
      header('Location: profil.php?id='.$_SESSION['id']);
   }


   if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['surnameUser']) {
      $newnom = htmlspecialchars($_POST['newnom']);
      $insertnom = $bdd->prepare("UPDATE user SET surnameUser = :surnameUser WHERE idUser = :idUser");
      //$insertprenom->execute($newprenom, $_SESSION['id']);
      $insertnom->execute(["surnameUser" => $newnom, 'idUser' => $_SESSION['id']]);
      header('Location: profil.php?id='.$_SESSION['id']);
   }


   if(isset($_POST['newemail']) AND !empty($_POST['newemail']) AND $_POST['newemail'] != $user['emailUser']) {
      $newemail = htmlspecialchars($_POST['newemail']);
      $insertemail = $bdd->prepare("UPDATE user SET emailUser = :emailUser WHERE idUser = :idUser");
      //$insertprenom->execute($newprenom, $_SESSION['id']);
      $insertemail->execute(["emailUser" => $newemail, 'idUser' => $_SESSION['id']]);
      header('Location: profil.php?id='.$_SESSION['id']);
   }


if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND $_POST['newpassword'] != $user['passwordUser']) {
      $newpassword = sha1($_POST['newpassword']);
      $insertpassword = $bdd->prepare("UPDATE user SET passwordUser = :passwordUser WHERE idUser = :idUser");
      //$insertprenom->execute($newprenom, $_SESSION['id']);
      $insertpassword->execute(["passwordUser" => $newpassword, 'idUser' => $_SESSION['id']]);
      header('Location: profil.php?id='.$_SESSION['id']);
   }


   if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $newpassword = sha1($_POST['newpassword']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($newpassword == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE user SET passwordUser = :passwordUser WHERE idUser = :idUser");
         $insertmdp->execute($newpassword, $_SESSION['id']);
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }


   if(isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['addressUser']) {
      $newadresse = htmlspecialchars($_POST['newadresse']);
      $insertadresse = $bdd->prepare("UPDATE user SET addressUser = :addressUser WHERE idUser = :idUser");
      //$insertprenom->execute($newprenom, $_SESSION['id']);
      $insertadresse->execute(["addressUser" => $newadresse, 'idUser' => $_SESSION['id']]);
      header('Location: profil.php?id='.$_SESSION['id']);
   }



   if(isset($_POST['newville']) AND !empty($_POST['newville']) AND $_POST['newville'] != $user['cityUser']) {
      $newville = htmlspecialchars($_POST['newville']);
      $insertville = $bdd->prepare("UPDATE user SET cityUser = :cityUser WHERE idUser = :idUser");
      //$insertprenom->execute($newprenom, $_SESSION['id']);
      $insertville->execute(["cityUser" => $newville, 'idUser' => $_SESSION['id']]);
      header('Location: profil.php?id='.$_SESSION['id']);
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

               <td align="left">
                     <a href="../index.php">Retourner au menu
                  </td>
            </tr>
         </table>
         <br/>

            <form method="POST" action="">
               <table>




                  <tr>
                     <td align="right">
                        <label for="nameUser">Prénom :</label>
                     </td>
                     <td>
                        <input type="text" name="newprenom" placeholder="Prénom" value="<?php echo $user['nameUser']; ?>" />
                     </td>
                  </tr>




                  <tr>
                     <td align="right">
                        <label for="surnameUser">Nom :</label>
                     </td>
                     <td>
                        <input type="text" name="newnom" placeholder="Nom" value="<?php echo $user['surnameUser']; ?>"/><br />
                     </td>
                  </tr>




                  <tr>
                     <td align="right">
                        <label for="emailUser">E-mail :</label>
                     </td>
                     <td>
                        <input type="text" name="newemail" placeholder="E-mail" value="<?php echo $user['emailUser']; ?>"/>
                     </td>
                  </tr>





                  <tr>
                     <td align="right">
                        <label for="passwordUser">Mot de passe :</label>
                     </td>
                     <td>
                        <input type="password" name="newpassword" placeholder="Mot de passe" />
                     </td>
                  </tr>




                  <tr>
                     <td align="right">
                        <label for="mdp2">Confirmation de mot de passe :</label>
                     </td>
                     <td>
                        <input type="password" name="mdp2" placeholder="Confirmation du mdp" />
                     </td>
                  </tr>



                  <tr>
                     <td align="right">
                        <label for="addressUser">Adresse :</label>
                     </td>
                     <td>
                        <input type="text" name="newadresse" placeholder="Adresse" value="<?php echo $user['addressUser']; ?>" />
                     </td>
                  </tr>




                  <tr>
                     <td align="right">
                        <label for="postalCodeUser">Code postal :</label>
                     </td>
                     <td>
                        <input type="text" name="newcodepostal" placeholder="Code postal" value="<?php echo $user['postalCodeUser']; ?>" />
                     </td>
                  </tr>




                  <tr>
                     <td align="right">
                        <label for="cityUser">Ville :</label>
                     </td>
                     <td>
                        <input type="text" name="newville" placeholder="Ville" value="<?php echo $user['cityUser']; ?>" />
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