<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
//$db = 'accounts';
$db = 'worknshare';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
