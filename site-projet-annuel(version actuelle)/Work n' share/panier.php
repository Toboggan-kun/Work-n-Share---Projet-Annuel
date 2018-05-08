<?php
session_start();
include("fonctions-panier.php");


   
$erreur = false;
   
$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;
   
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   
   $l = preg_replace('#\v#', '',$l);
   $p = floatval($p);
   
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
       
}
   
if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;
   
      Case "suppression":
         supprimerArticle($l);
         break;
   
      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            if (isset($_SESSION['panier']['libelleProduit'][$i], $QteArticle[$i]))
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;
   
      Default:
         break;
   }
}
   
echo '<?xml version="1.0" encoding="utf-8"?>';?>
<head>
<title>Votre panier</title>
</head>
<body>
   
<form method="post" action="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" name="panier">
<table style="width: 400px">
    <tr>
        <td colspan="4">Votre panier</td>
    </tr>
    <tr>
        <td>Libellé</td>
        <td>Quantité</td>
        <td>Prix Unitaire</td>
        <td>Action</td>
    </tr>
   
   
    <?php
    if (creationPanier())
    {
       $nbArticles=count($_SESSION['panier']['libelleProduit']);
       if ($nbArticles <= 0)
       echo "<tr><td>Votre panier est vide </ td></tr>";
       else
       {
          for ($i=0 ;$i < $nbArticles ; $i++)
          {
             echo "<tr>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
             echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/><input type=\"button\" value=\"+\" onclick=\"document.forms['panier'].elements[".(3 * $i)."].value = parseFloat(document.forms['panier'].elements[".(3 * $i)."].value) + 1; document.forms['panier'].submit();\"><input type=\"button\" value=\"-\" onclick=\"document.forms['panier'].elements[".(3 * $i)."].value = parseFloat(document.forms['panier'].elements[".(3 * $i)."].value) - 1; document.forms['panier'].submit();\"></td>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
             echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
             echo "</tr>";
          }
   
          echo "<tr><td colspan=\"2\"> </td>";
          echo "<td colspan=\"2\">";
          echo "Total : ".MontantGlobal();
          echo "</td></tr>";
   
          echo "<tr><td colspan=\"4\">";
          echo "<input type=\"submit\" value=\"Rafraichir\"/>";
          echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
   
          echo "</td></tr>";
       }
    }
    ?>
</table>
</form>
</body>
</html>