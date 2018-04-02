<?php
	require "class/formClass.php";
	$form = new Form($_POST);

	echo '<label>Nouveau nom</label>'; echo $form->input('nameUser', 'Nom');
	echo '<label>Nouveau prénom</label>'; echo $form->input('surnameUser', 'Prénom');
	echo '<label>Nouveau mail</label>'; echo $form->input('emailUser', 'Email');
	echo '<label>Nouveau mot de passe</label>'; echo $form->input('passwordUser', 'Mon nouveau mot de passe');
	echo '<label>Confirmez votre nouveau mot de passe</label>'; echo $form->input('passwordUser2', 'Confirmez votre mot de passe');
	echo '<input type="button" value="Valider"> </input>';
	echo '<input type="button" value="Annuler"> </input>';

?>