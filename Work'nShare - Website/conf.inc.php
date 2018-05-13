<?php

session_start();

$currentDateEN = date("Y-m-d");
$currentDateFR = date("d-m-Y");
$currentTime = date("H:i");

$_SESSION['currentDateEN'] = $currentDateEN;
$_SESSION['currentDateFR'] = $currentDateFR;
$_SESSION['currentTime'] = $currentTime;