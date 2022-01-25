<?php

class QueryBuilder {

    private string $select;
    private string $from;
    private string $where;

    public function select($select) {
        $select = str_replace(['`',";"], ["",""], $select);
        $selectParts = explode(',', $select);
        $selectParts = array_map(function($item){
            return "`" . trim($item) . "`";
        }, $selectParts);

        $this->select = implode(", ", $selectParts);
        return $this;
    }

    public function from(string $tableName) {
        $tableName = str_replace(['`',";"], ["",""], $tableName);
        $this->from = "`{$tableName}`";
        return $this;
    }

    public function where(string $colName, string $operator, string $value) {
        $colName = str_replace(['`',";"], ["",""], $colName);
        $operator = str_replace(['`',";"], ["",""], $operator);
        $value = str_replace(['`',";"], ["",""], $value);
        $this->where = "`{$colName}` {$operator} '{$value}'";
        return $this;
    }

    public function getSQL():string {
        $sql = "SELECT {$this->select} FROM {$this->from}";
        if(!empty($this->where)){
            $sql = "{$sql} WHERE {$this->where}";
        }
        return $sql;
    }
}