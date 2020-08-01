<?php

class Conection {
    private $host       = 'localhost';
    private $dbName     = 'carrito';
    private $dbUser     = 'root';
    private $dbPassword = '';
    private $connect;

    public function connect(){
        try {
            $this->connect = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->dbUser,$this->dbPassword);
        } catch (exception $e) {
           die($e);
        }

        return $this->connect;
    }
}