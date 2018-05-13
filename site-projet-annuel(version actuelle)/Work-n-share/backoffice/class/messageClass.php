<?php


class Message{

	public $listOfErrors = [];
	public $listOfMsg = [];
	public $listOfErrorsMenu = [];

	public $listOfErrorsUser = [];
	public $listOfErrorsEvent = [];
	public $listOfErrorsRoom = [];
	public $listOfErrorsEquipment = [];
	public $listOfErrorsBooking = [];
	public $listOfErrorsTicket = [];
	public function __construct(){
		
	}
	public function listOfErrors(){

	}
	public function listOfMsg($indexMsg){

		$listOfMsg = [

			1=>"La plage horaire a bien été modifiée",
			2=>"test"

		];
		return $listOfMsg[$indexMsg];
	}

	public function listOfErrorsMenu($indexMsg){
		$listOfErrorsMenu = 

			[
				1 => "Le nom du menu doit contenir 5 à 50 caractères",
				2 => "Le nom de l'entrée doit contenir 5 à 50 caractères ",
				3 => "Le nom du plat doit contenir 5 à 50 caractères ",
				4 => "Le nom du dessert doit contenir 5 à 50 caractères ",
				5 => "La quantité saisie doit être comprise entre 1 à 100",
				6 => "Votre menu a bien été ajouté",
				7 => "Le menu du jour a été remplacé",
				8 => "Le nom du menu saisi existe déjà",

				9 => "Veuillez cocher un des boutons",
				10 => "Le menu a bien été supprimé",
				11 => "Le menu a bien été modifié"


			];
		return $listOfErrorsMenu[$indexMsg];
		}
	

	public function listOfErrorsUser($indexMsg){
		$listOfErrorsUser = [

			1 => "L'utilisateur a bien été suspendu jusqu'à nouvel ordre",
			2 => "Vous avez annulé la suspension de l'utiliateur",
			3 => "Le numéro de carte bleue saisi est invalide",
			4 => "Le code sécurité saisi est invalide",
			5 => "La date d'expiration est invalide"
		];
		return $listOfErrorsUser[$indexMsg];
	}
	public function listOfErrorsEvent($indexMsg){
		$listOfErrorsEvent = [

			1 => "Ce titre existe déjà",
			2 => "Le titre de l'évènement doit contenir au moins 5 caractères",
			3 => "Veuillez insérer une date valide",
			4 => "Veuillez insérer un horaire valide",
			5 => "La description doit contenir au moins 10 caractères",
			6 => "L'évènement a bien été ajouté",
			7 => "L'évènement a bien été supprimé",
			8 => "L'évènement a bien été modifié", 
			9 => "Le code postal doit composer 5 chiffres",
			10 => "Veuillez saisir une adresse valide",
			11 => "Veuillez saisir un nom de ville valide",
			12 => "Vous n'avez pas saisi d'horaire",
			13 => "Vous n'avez pas saisi de date",
			14 => "Vous n'avez pas choisi de lieu",
			15 => "Un évènement est déjà prévu pour cet openspace, veuillez choisir une autre date"


		];
		return $listOfErrorsEvent[$indexMsg];
	}
	public function listOfErrorsRoom($indexMsg){
		$listOfErrorsRoom = [

			1 => "La salle a bien été supprimée",
			2 => "Veuillez choisir un openspace",
			3 => "Veuillez saisir un type de salle",
			4 => "Le nom de la salle doit contenir au moins 5 caractères",
			5 => "La salle a bien été modifiée",
			6 => "La salle a bien été ajoutée",
			7 => "Le nom de la salle existe déjà"

		];
		return $listOfErrorsRoom[$indexMsg];
	}

	public function listOfErrorsEquipment($indexMsg){
		$listOfErrorsEquipment = [

			1 => "L'équipement a bien été ajouté",
			2 => "Le nom de l'équipement existe déjà",
			3 => "L'équipement a bien été supprimé",
			4 => "L'équipement a bien été modifié",
			5 => "Veuillez saisir un nom d'équipement"

		];
		return $listOfErrorsEquipment[$indexMsg];
	}

	public function listOfErrorsBooking($indexMsg){
		$listOfErrorsBooking = [
			1 => "Votre réservation a bien été pris en compte",
			2 => "Veuillez saisir vos coordonnées bancaires",
			3 => "Cette date est dépassée",
			4 => "Cette saisie est invalide",
			5 => "Le numéro de carte bleue saisi est invalide",
			6 => "Le code sécurité saisi est invalide",
			7 => "La date d'expiration est invalide",
			8 => "Vous n'avez pas saisi d'horaire",
			9 => "Il semblerait qu'il n'y ait plus de salles disponibles pour cette date, veuillez modifier votre demande",
			10 => "Veuillez choisir une salle"
 
		];
		return $listOfErrorsBooking[$indexMsg];
	}
	public function listOfErrorsTicket($indexMsg){
		$listOfErrorsTicket = [
		
			1 => "Veuillez saisir un sujet d'incident",
			2 => "Veuillez saisir une description",
			3 => "Veuillez choisir la désignation de l'équipement",
			4 => "Votre ticket a bien été envoyé",
			5 => "Veuillez saisir un message, vous ne pouvez pas saisir un message vide",
			6 => "Votre message a été envoyé",
			7 => "L'état du ticket a bien été modifié"

 
		];
		return $listOfErrorsTicket[$indexMsg];
	}
	
}
?>