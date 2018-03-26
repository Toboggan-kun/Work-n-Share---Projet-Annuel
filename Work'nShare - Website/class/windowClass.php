<?php

class Window{

	private $message;

	public function __construct(){

	}

	public function createBox($myMessage){ //CORPS DE LA FENETRE: MESSAGES D'ALERTES, DE CONFIRMATION, D'ERREURS
		$this->message = $myMessage;
		return
				"<section id ='window'>
		            <div>
		                <h2>Attention</h2>
		                <p>" . $this->message . "</p>
		                <button id='close' onclick='showPopup('window')'>Fermer</button>
		            </div>
		        </section>";
	}

	public function createWindow(){

		return

		'
			<section>



			</section>

		';
	}

}
