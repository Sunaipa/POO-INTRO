<?php

class PersonDAO {
    private PDO $pdo;
    private PDOStatement $statement;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(array $orderBy = [], array $limit = []):self {
        $sql = "SELECT * FROM persons ";
        if(! empty($orderBy)) {
            $sql .= "ORDER BY ";
            $orderCols = [];
            foreach($orderBy as $colName => $order){
                $orderCols[] = "$colName $order ";
            }
            $sql .= implode(", ", $orderCols);            
            //Autre option qui fonctionne
            // $sql .= "ORDER BY ";
            // foreach($orderBy as $colName => $order) {
            //        $sql .= $key ;
            //        if (!$key == array_key_last($orderBy)) {
            //         $sql .= ",";
            //        }
            //        $sql .= " ";                  
            // };
            // $sql .= $orderBy[$key] . " ";
            // var_dump($sql);
            //
        }
        if(! empty($limit)) {
            $limit = array_map(function ($item){return (int)$item;}, $limit );

            $sql .= "LIMIT " . $limit["limit"];
            if (array_key_exists("offset", $limit)) {
                $sql .= ", " . $limit["offset"] . " ";
            }
        }
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute();
        return $this;
    }

    public function getAllAsArray() {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAsObject():array {
        $data = $this->getAllAsArray();
        $objectList = [];
        foreach ($data as $row) {
            $objectList[] = $this->hydrate($row);
        }
        return $objectList;
    }

    public function snakeToCamelCase(string $name) {
        $nameParts = explode("_", $name);
        $camel = array_shift($nameParts);
        $nameParts = array_map(function ($item){return ucfirst($item);}, $nameParts);
        return $camel . implode("", $nameParts);
    }

    public function hydrate(array $data) {
        $person = new Person();
        foreach ($data as $key => $value) {
            $methodName = "set" . $this->snakeToCamelCase($key);
            if (method_exists($person, $methodName)) {
                $person->$methodName($value);
            }
        }
        return $person;
    }



}

