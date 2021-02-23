<?php 
session_start();
error_reporting(E_ALL); 
date_default_timezone_set('Asia/Bangkok');
/**
 * Connect Database
 */
class Database {
    /** DSN -> Data Source Name */
    private $host = "localhost";
    private $dbname = "project";
    private $username = "root";
    private $password = "";
    private $response;
    private $conn;

    public function connect() {
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Success";
        }catch(PDOException $exception){
            echo "Database not connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>