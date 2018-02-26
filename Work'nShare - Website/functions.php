<?php
	
	require_once "conf.inc.php";


	//CONNEXION A LA BASE DE DONNEES
	function connectBDD() {
		try{
			$bdd = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PWD);
		}catch(Exception $e){
			die("Erreur SQL: ". $e->getMessage() );
		}
		return $bdd;
	}

	//GENERATEUR DE TOKEN
	function generateToken(){
		$token = md5(uniqid()."fkjrgreklgrffep");
		return $token;
	}
	//RECUPERER L'ADRESSE IP D'UN VISITEUR
	function getip(){
		// IP si internet partagé
		if(isset($_SERVER['HTTP_CLIENT_IP'])){
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		// IP derrière un proxy
		elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Sinon : IP normale
		else{
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}
	