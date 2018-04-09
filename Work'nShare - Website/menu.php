<?php

include "header.php";

?>
	<h2>Gestion des menus</h2>
	<div id="actualMenu">
		<h3>Menu actuel</h3>
		<p>Nom menu :</p>
		<li>Entrée :</li>
		<li>Plat :</li>
		<li>Dessert :</li>
		<li>Boisson: au choix</li>
	</div>

	<div id="editMenu">
		<h3>Edition du menu</h3>

	</div>
	<div id="editMenu">
		<h3>Ajouter un menu</h3>
		<span>Titre du menu</span><span><input type="text" placeholder="Titre" required="required"></input></span>
		<span>Nom de l'entrée</span><span><input type="text" placeholder="Nom de l'entrée" required="required"></input></span>
		<span>Nom du plat</span><span><input type="text" placeholder="Nom du plat" required="required"></input></span>
		<span>Nom du dessert</span><span><input type="text" placeholder="Nom du dessert" required="required"></input></span>
		<input type="button" value="Ajouter">
	</div>
</center>
