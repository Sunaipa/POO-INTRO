<?php

class PersonDAO extends AbstractDAO{

    public function __construct(PDO $pdo) {
        parent::__construct($pdo, "persons",Person::class);
        $this->foreignkeys = ["address"];
    }


    public function hydrate(array $data) {
        $person = parent::hydrate($data);

        $addressDAO = new AddressDAO($this->pdo);

        if ($data["address_id"]){
            $address = $addressDAO
                        ->findOneById($data["address_id"])
                        ->getOneAsObject();
            $person->setAddress($address);
        }
        return $person;
    }

    public function update(EntityInterface $entity):void {
        $this->manageAssociations($entity);
        parent::update($entity);
    }

    public function insert(EntityInterface $entity):void {         
        $this->manageAssociations($entity);
        parent::insert($entity);
    }

    protected function manageAssociations(Person $person) {  
        /** @var Address*/
        $address = $person->getAddress();
        if($address) {
            $addressDAO = new AddressDAO($this->pdo);
            $addressDAO->save($address);
        }
    }
}