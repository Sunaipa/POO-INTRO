<?php

class PersonDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(array $orderBy = [], array $limit = []) {
        $sql = "SELECT * FROM persons ";
        if(! empty($orderBy)) {
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
            $sql .= "ORDER BY ";
            $orderCols = [];
            foreach($orderBy as $colName => $order){
                $orderCols[] = "$colName $order ";
            }
            $sql .= implode(", ", $orderCols);            
        }
        if(! empty($limit)) {
            $limit = array_map(function ($item){return (int)$item;}, $limit );

            $sql .= "LIMIT " . $limit["limit"];
            if (array_key_exists("offset", $limit)) {
                $sql .= ", " . $limit["offset"] . " ";
            }
        }
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function snakeToCamelCase(string $name) {
        $nameParts = explode("_", $name);
        $camel = array_shift($nameParts);
        $nameParts = array_map(function ($item){return ucfirst($item);}, $nameParts);
        return $camel . implode("", $nameParts);
    }
}