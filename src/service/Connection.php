<?php

class Connection
{
    private String $servername =  'localhost';
    private String $username =  'lucascdafonseca';
    private String $password =  'Qpwo@1029';

    private PDO $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=serenatto", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
