<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php'; ?>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Menu</a></li>
			<li class="active">Abonnements</li>

		</ol>
		<?php		
		session_start();
		include("fonctions-panier.php");
		include("abonnements/index.php");
		?>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-4 sidebar sidebar-right">


			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
<?php require 'footer.php'; ?>
</html>