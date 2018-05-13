<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php'; ?>
	<!-- Header -->
	<header id="head">
		<div class="container">
			<div class="row">
				<h1 class="lead">WORK N' SHARE</h1>
			</div>
		</div>
	</header>
	<!-- /Header -->

	<!-- Intro -->
	<div class="container text-center">
		<br> <br>
		<h2 class="thin">Work n' share</h2>
		<p class="text-muted">
			Des locaux tous neufs et prêts à vous accueillir.
		</p>
	</div>
	<!-- /Intro-->
		
	<!-- Highlights - jumbotron -->
	<div class="jumbotron top-space">
		<div class="container">
			
			<h3 class="text-center thin">Services</h3>
			
			<div class="row">
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-pencil fa-5"></i>Espaces de travail</h4></div>
					<div class="h-body text-center">
						<p>Nous disposons de plusieurs salles que vous pourrez réserver afin de travailler dans les meilleurs conditions.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-coffee fa-5"></i>Boissons à volonté</h4></div>
					<div class="h-body text-center">
						<p>Une petite soif? Gardez en tête que les boissons sont offertes et à volonté dès lors que vous avez payé, peu importe si vous avez un abonnement ou non! C'est la maison qui régale. </p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-heart fa-5"></i>Calme</h4></div>
					<div class="h-body text-center">
						<p>Nous mettons un point d'honneur à garder nos locaux propres et calmes afin de vous offrir les meilleurs conditions de travail possible (encore une fois)</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-smile-o fa-5"></i>Nous sommes là pour vous en cas de besoin</h4></div>
					<div class="h-body text-center">
						<p>Un problème? Une question? Vous trouverez toujours à l'accueil quelqu'un pour vous aider.</p>
					</div>
				</div>
			</div> <!-- /row  -->
		
		</div>
	</div>
	<!-- /Highlights -->

	<!-- container -->
	<div class="container">


</div>	<!-- /container -->
	

	<div id="chatBox"></div>
	<link rel="stylesheet" href="../messagerie/css/app.css">
	<?php require 'footer.php'; ?>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="script.js" onload="loadChatBox()"></script>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>