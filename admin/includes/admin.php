<?php require_once 'require.php'; ?>
<?php

class Admin extends databaseObject {

    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
    public $email;
    public $errorArray = array();
    public static $table_name = "admin";
    public static $table_fields = array("id", "firstname", "lastname", "username", "password", "email");

    public function __toString() {
        return $this->firstname . " " . $this->lastname;
    }

    public static function authenticate($username, $password) {

        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE username = '" . $username . "' AND password = '" . md5($password) . "' LIMIT 1";
        $result = static::findBySql($sql);
        return (!empty($result)) ? array_shift($result) : false;
    }

//** usage of PDO object
//        $dbh = new PDO("mysql:host=localhost;dbname=obuka", 'root', '');
//        $sth = $dbh->prepare($sql);
//        $sth->execute(array(
//            ':username' => $username,
//            ':password' => md5($password)
//        ));
//        
//        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
//        foreach ($results as $result) {
//            var_dump($result);
//        }
//        exit('Done');
//***************************************
}

?>
