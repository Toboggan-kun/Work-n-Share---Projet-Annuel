<?php

class Window{

	public $optionMessage;
	public $message;

	public function __construct(){

	}

	public function createBox($message){ //CORPS DE LA FENETRE: MESSAGES D'ALERTES, DE CONFIRMATION, D'ERREURS
		$this->message = $message;

		return
				"<section id ='background'>
		            <div id='window'>
		                <h2>Attention</h2>
		                
		                	<p>" . $this->message . "</p>
		                	<input type='button' id='close' value='Annuler' onclick='closePopup()'></input>
		                	<input type='button' id='close' value='Confirmer'></input>

		           
		            </div>
		        </section>";
	}

	public function errorBox($myMessage, $optionMessage){
		$this->message = $myMessage;
		$this->optionMessage = $optionMessage;

		/*switch ($this->optionMessage) {
			case '1':
				$this->message = "";
				break;
			
			default:
				$this->message = "";
				break;
		}*/
		return
				"<section id ='background'>
		            <div id='window'>
		                <h2>Erreur</h2>
		                
		                	<p>" . $this->message . "</p>
		                	<input type='button' id='close' value='Fermer' onclick='closePopup()'></input>
		                	

		           
		            </div>
		        </section>";
	}

	public function createMiniatureEventBox($title, $description){
		return 
			'
			<li>
				<img src="">
				<h3>'. $title . '</h3>
				<p>' . $description .  '</p>
			</li>

			';
	}



}
