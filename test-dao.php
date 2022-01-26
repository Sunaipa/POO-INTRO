<?php
require "autoload.php";

$pdo = new PDO(
    "mysql:host=localhost;dbname=formation_cda_2022;charset=utf8",
    "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


$dao = new PersonDAO($pdo);

$dao->snakeToCamelCase("prix_du_pain");

var_dump($dao->findAll(
    ["last_Name" => "ASC", "address_id" => "DESC"], 
    ["limit" => 3, "offset" => 3])->getAllAsObject()
);