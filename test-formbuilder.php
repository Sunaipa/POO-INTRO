<?php
require "autoload.php";

$form = new Form("post", "action");

$form->addField(new InputField("userName", "text", "Nom Utilisateur"))
->addField(new PasswordField("pass", "Mot de passe"))
->addField(new InputField("role", "text", "Role"))
->add(InputField::class, ["name" => "firstName"])
->add(InputField::class, ["name" => "lastName"]);

$form->add(InputField::class, ["name" => "age"]);






 $p = new Person();
$p->setFirstName("Ada")->setLastName("LoveLace");
$form->hydrateFromObject($p);

//$form->hydrateFromArray($_POST);
// $form->hydrateFromArray([
//     "userName" => "bob", "pass" => "123", "role" => "user"
// ]);

echo $form->getOpeningTag();

echo $form->getField("userName");
echo $form->getField("pass");
echo $form->getField("role");
echo $form->getField("firstName");
echo $form->getField("lastName");

echo $form->getClosingTag();
