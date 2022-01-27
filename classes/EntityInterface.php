<?php 

interface entityInterface {
    public function getId():?int;
    public function setId(int $id):self;
}