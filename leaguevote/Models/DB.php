<?php
require '.env';

use PDO;

class DB
{
    private $host = "a2nlmysql29plsk.secureserver.net:3306";
    private $dbname = "League_Vote";
    private $username = $dbUser;
    private $password = $dbPassword;
    public $conn = null;


    public function Connect()
    {
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password, $options);

            return $this->conn;
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }

}
?>