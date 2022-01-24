<?php

require "classes/facture.php";
require "classes/client.php";

$facture = new Facture("00001", 100, new DateTime(), new Client(1, "Sophie"));

$client = new Client(2, "paul");

$client->addFacture(new Facture("0002", 120, new DateTime(), $client));
$client->addFacture(new Facture("0003", 180, new DateTime(), $client));
$client->addFacture(new Facture("0004", 170, new DateTime(), $client));

var_dump($client->getChiffreAffaire());
var_dump($facture->getMontantTTC());