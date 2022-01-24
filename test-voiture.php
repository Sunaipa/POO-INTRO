<?php
require "classes/Voiture.php";

$maVoiture = new Voiture(5,5);
$maVoiture->turn();
$maVoiture->turn();
$maVoiture->move(2);
$maVoiture->turn();
$maVoiture->move(10);
var_dump("$maVoiture");

$monBateau = new Bateau(2,2);
$monBateau->turn();
$monBateau->move(3);
var_dump("$monBateau");