<?php 
include "header.php";

require "class/windowClass.php";

echo "ok";
$window = new Window();
echo $window->createBox("Message test");


