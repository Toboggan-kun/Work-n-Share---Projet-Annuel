<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Work & share</title>

	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Menu</a></li>
					<li class="active"><a href="prices.php">Abonnements</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Nos espaces de travail <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="bastille.php">Bastille</a></li>
							<li class="active"><a href="republique.php">Republique</a></li>
							<li class="active"><a href="odeon.php">Odeon</a></li>
							<li class="active"><a href="placeditalie.php">Place d'Italie</a></li>
							<li class="active"><a href="ternes.php">Ternes</a></li>
							<li class="active"><a href="beaubourg.php">Beaubourg</a></li>
						</ul>
					</li>
					<li><a href="contact.php">Nous contacter</a></li>
					<li><a class="btn" href="signin.php">S'INSCRIRE / S'ABONNER</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Menu</a></li>
			<li class="active">Abonnements</li>

		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Abonnements</h1>
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
				</header>
				
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-4 sidebar sidebar-right">

				<div class="widget">
					<h4>Services</h4>
					<ul class="list-unstyled list-spaces">
						<li><a href="">Lorem ipsum dolor</a><br><span class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, laborum.</span></li>
						<li><a href="">Totam, libero, quis</a><br><span class="small text-muted">Suscipit veniam debitis sed ipsam quia magnam eveniet perferendis nisi.</span></li>
						<li><a href="">Enim, sequi dignissimos</a><br><span class="small text-muted">Reprehenderit illum quod unde quo vero ab inventore alias veritatis.</span></li>
						<li><a href="">Suscipit, consequatur, aut</a><br><span class="small text-muted">Sed, mollitia earum debitis est itaque esse reiciendis amet cupiditate.</span></li>
						<li><a href="">Nam, illo, veritatis</a><br><span class="small text-muted">Delectus, sapiente illo provident quo aliquam nihil beatae dignissimos itaque.</span></li>
					</ul>
				</div>

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	

	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+234 23 9873237<br>
								<a href="mailto:#">some.email@somewhere.com</a><br>
								<br>
								234 Hidden Pond Road, Ashland City, TN 37015
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons clearfix">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Notre but</h3>
						<div class="widget-body">
							<p>Nous voulons vous offrir la meilleure qualité de service à laquelle vous n'ayez eu droit afin que vous reveniez car vous avez jugé que les conditions de travail étaient propices à votre épanouissement au travail.</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Menu</a> | 
								<a href="prices.php">Abonnements</a> |
								<a href="sidebar-right.php">Services</a> |
								<a href="contact.php">Nous contacter</a> |
								<b><a href="signup.php">S'inscrire</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2014, Your name. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>	
		




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>