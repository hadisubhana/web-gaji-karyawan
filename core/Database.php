<?php

class Database {

    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    private $db       = "karyawan";
    private $charset  = "utf8";
    private $conn;

    public function __construct() {
        
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset};";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Failed : " . $e->getMessage();
        }
    }

    public function conn() {
        return $this->conn;
    }

}