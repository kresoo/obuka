<?php

class Customer extends databaseObject {

    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
    public $email;
    public $errorArray = array();
    
    public static $table_name = "customer";
    public static $table_fields = array("id", "firstname", "lastname", "username", "password", "email");

    public static function authenticate($username, $password) {
        global $database;
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE username = '" . $username . "' AND password = '" . md5($password) . "' LIMIT 1";
        $result = static::findBySql($sql);
        return (!empty($result)) ? array_shift($result) : false;
    }

    public function attachObjectAttributes($values) {
        global $database;
        foreach ($values as $key => $value) {
            if (empty($value)) {
                $this->errorArray[] = "You must provide all fields";
                return false;
            }
        }
        if (strlen($values['firstname']) > 45) {
            $this->errorArray = "Firstname cant be longer than 45 characters";
            return false;
        }
        if (strlen($values['lastname']) > 45) {
            $this->errorArray = "Lastname cant be longer than 45 characters";
            return false;
        }
        if (strlen($values['username']) > 45) {
            $this->errorArray = "Username cant be longer than 45 characters";
            return false;
        }
        if (strlen($values['password']) > 45 || strlen($values['password']) < 8) {
            $this->errorArray = "Password must between 8 and 45 characters";
            return false;
        }
        if (strlen($values['email']) > 45) {
            $this->errorArray = "Email cant be longer than 45 characters";
            return false;
        }
        $sql = "SELECT username FROM " . static::$table_name . " WHERE username = '" . $values['username'] . "'";
        $result = $database->query($sql);
        if ($database->num_rows($result) != 0) {
            $this->errorArray[] = "Username already in use. Choose another one";
            return false;
        }

        foreach ($values as $key => $value) {
            if ($key == "password") {
                $this->$key = md5($value);
            } else {
                $this->$key = $value;
            }
        }
    }

    public function fullname() {
        return $this->firstname . " " . $this->lastname;
    }

}
