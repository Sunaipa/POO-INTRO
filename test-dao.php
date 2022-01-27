<?php
require "autoload.php";

$pdo = new PDO(
    "mysql:host=localhost;dbname=formation_cda_2022;charset=utf8",
    "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


$dao = new PersonDAO($pdo);
// var_dump($dao);
$addressDao = new AddressDAO($pdo);

// $dao->snakeToCamelCase("prix_du_pain");

// var_dump($dao->findAll(
//     ["last_Name" => "ASC", "address_id" => "DESC"], 
//     ["limit" => 3, "offset" => 3])->getAllAsObject()
// );


try {
    // var_dump(
    //     $dao->find(["address_id" => "1"], ["last_name"=>"DESC"], ["limit" => 3, "offset" => 3])->getAllAsObject()
    // );
        // var_dump(
        //     $addressDao->countPersonsByAdresses()
        // );
        
       //echo $dao->deleteOneById(1);

    // $p = $dao->findOneById(12)->getOneAsObject();
    // $p->setLastName("tyty");
    // $dao->save($p);

    $p = new Person();
    $p->setFirstName("jascques")->setLastName("Coeur");
    $a = new Address();
    $a->setStreet("3 rue des boulets")->setZipCode("75020")->setCity("Paris");
    $p->setAddress($a);
    $dao->save($p);
    var_dump($p);


} catch(PDOException $e) {
    echo " $e";

} catch(NotFoundException $e) {
    echo "<div>Il n'y a pas de résultats </div>";
}