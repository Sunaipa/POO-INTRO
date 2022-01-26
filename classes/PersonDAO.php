<?php

class PersonDAO {

    private PDO $pdo;

    private PDOStatement $statement;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(array $orderBy = [], array $limit = []): self {
        $sql = "SELECT * FROM persons ";

        $sql .= $this->getOrderBy($orderBy);
        $sql .= $this->getLimit($limit);
        

        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute();
        return $this;
    }

    private function getOrderBy(array $orderBy):string {
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
        $sql = "";
        if (count($orderBy) > 0) {
            $sql = " ORDER BY ";
            $orderCols = [];
            foreach ($orderBy as $colName => $order) {
                $orderCols[] = "$colName $order";
            }
            $sql .= implode(", ", $orderCols);
        }
        return $sql;
    }

    private function getLimit(array $limit):string {
        $sql = "";
        if(count($limit)> 0){
            $limit = array_map(function($item){ 
                return (int) $item;
            }, $limit);

            $sql .= " LIMIT {$limit["limit"]}";

            if(array_key_exists("offset", $limit)){
                $sql .= " OFFSET {$limit["offset"]}";  // OFFSET ou ,
            }
        }
        return $sql;
    }

    public function findOneById(int $id): self {
        $sql = "SELECT * FROM persons WHERE id=?";
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute([$id]);
        return $this;
    }

    public function find( array $search = [], 
                          array $orderBy = [], array $limit = []): self {
        $sql = "SELECT * FROM persons ";
        $searchFields = [];
        if(count($search) > 0){
            $sql .= "WHERE ";
            $searchFields = array_map(function($item){
                return "{$item} = :{$item}";                                                                                          
            }, array_keys($search));

            $sql .= implode(" AND ", $searchFields);;
        };

        $sql .= $this->getOrderBy($orderBy);
        $sql .= $this->getLimit($limit);

        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($search);
        return $this; 
    }

    public function getOneAsArray(): array {
        $data = $this->statement->fetch(PDO::FETCH_ASSOC);
        if($data){
            return $data;
        } else {
            throw new NotFoundException("Pas de données pour cette requête");
        }
    }

    public function getOneAsObject(): Person {
        $data = $this->getOneAsArray();
        var_dump($data);
        return $this->hydrate($data);
    }

    public function getAllAsArray(): array {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAsObject(): array{
        $data = $this->getAllAsArray();
        $objectList = [];
        foreach($data as $row){
            $objectList[] = $this->hydrate($row);
        }
        return $objectList;
    }

    public function snakeToCamelCase(string $name){
        $nameParts = explode("_", $name);
        $camel = array_shift($nameParts);
        $nameParts = array_map(function($item){ return ucfirst($item);}, $nameParts);

        return $camel . implode("", $nameParts);
    }

    public function hydrate(array $data){
        $person = new Person();
        foreach($data as $key => $value){
            $methodName = "set". $this->snakeToCamelCase($key);
            if(method_exists($person, $methodName)){
                $person->$methodName($value);
            }
        }

        return $person;
    }


}