<?php

class PasswordField extends InputField {

    public function __construct(string $name, string $label) {
        parent::__construct($name, "password", $label);
    }
}