<?php

class Database {

    private $host = "localhost";
    private $db   = "stadiumpass";
    private $user = "root";
    private $pass = "2004";

    public function connect() {
        return new PDO(
            "mysql:host=$this->host;dbname=$this->db;charset=utf8",
            $this->user,
            $this->pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }
}