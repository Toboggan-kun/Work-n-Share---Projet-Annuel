<?php

session_start();

$currentDateEN = date("Y-m-d");
$currentDateFR = date("d-m-Y");
$currentTime = date("H:i");

$_SESSION['currentDateEN'] = $currentDateEN;
$_SESSION['currentDateFR'] = $currentDateFR;
$_SESSION['currentTime'] = $currentTime;


function regenerateAccessToken($id){
	$accessToken = md5(uniqid()."udanzspzikapod");


	$db->connectDataBase();

	$query = $db->prepareQuery("UPDATE user SET token=:token WHERE email = :email");
	$db->executeQuery([	"token"=>$accessToken,
						"email"=>$_SESSION['email']
										]);

	return $accessToken;
}

