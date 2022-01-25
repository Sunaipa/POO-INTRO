<?php
require "autoload.php";
//require "classes/QueryBuilder.php";

$qb = new QueryBuilder();
$qb->select("id, name, `DROP TABLE`")
    ->from("persons")
    ->where("id", "=", 5);

//SELECT name FROM persons WHERE id=5
// echo $qb->getSQL();
echo $qb->getSQL();