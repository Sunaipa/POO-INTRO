<?php

class Form {
    private string $method;
    private string $action;
    private array $fields = [];


    public function __construct(string $method, string $action = "") {
        $this->method = $method;
        $this->action = $action;
    }
    public function getOpeningTag() { 
        $html ="<form method=\"{$this->method}\" ";
        if (! empty($this->action)) {
            $html .= " action=\"{$this->action}\" ";
        }
        $html .= ">";
        return $html;
    }
    public function getClosingTag() { 
        return "<button type=\"submit\">Valider</button></form>";
    }
    public function addField(InputFieldInterface $field) {
        $this->fields[$field->getName()] = $field;
        return $this;
    }

    public function add(string $className, array $params = []){
        if (!array_key_exists("name",$params)) {
            throw new Exception("Un champs doit avoir un name");
        }
        if (!array_key_exists("label",$params)) {
            $params["label"] = $params["name"];
        }

        $field = new $className();

        foreach($params as $key => $val) {
            $methodName = "set". ucfirst($key);
            if (method_exists($field, $methodName)) {
                $field->$methodName($val);
            }
        }

        return $this->addField($field);
    }

    public function getField(string $name) {
        if (array_key_exists($name, $this->fields)) {
            return "<div>" . $this->fields[$name] . "</div>";
        } else {
            throw new Exception("La clé $name n'existe pas");
        }
        
    }
    
    public function hydrateFromArray(array $data) {
        foreach ($this->fields as $key => $field) {
            if (array_key_exists($key, $data)) {
                $field->setValue($data[$key]);
            }
        }
    }  

    public function hydrateFromObject($entity) {

        foreach ($this->fields as $key => $field) {
            $methodName = "get". ucfirst($key);
            if (method_exists($entity, $methodName)) {
                $field->setValue($entity->$methodName());
            }
        }
 }
}

