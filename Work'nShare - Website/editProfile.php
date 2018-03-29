<?php
	if(isset($_POST['changeNode'])){
		echo $form->input('nameUser', 'Nom');
		echo $form->input('surnameUser', 'Prénom');
		echo $form->input('emailUser', 'Email');
		echo $form->input('passwordUser', 'Mon nouveau mot de passe');
		echo $form->input('passwordUser2', 'Confirmez votre mot de passe');
		echo $form->submit('Valider');
		echo $form->submit('Annuler');
	}
?>