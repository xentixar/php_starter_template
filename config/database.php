<?php

include_once __DIR__ . '/environment.php';

class Database
{
    private $server_name;
    private $user_name;
    private $password;
    private $database_name;
    private $conn;

    public function __construct()
    {
        try {
            $this->getData();
            $this->conn = new mysqli($this->server_name, $this->user_name, $this->password, $this->database_name);
        } catch (Exception $e) {
            echo $e;
        }
    }

    protected function getData()
    {
        $this->server_name = getenv('DATABASE_SERVER') ?? 'localhost';
        $this->user_name = getenv('DATABASE_USERNAME') ?? 'root';
        $this->password = getenv('DATABASE_PASSWORD') ?? '';
        $this->database_name = getenv('DATABASE_NAMe') ?? 'test_db';
    }

    public function connect()
    {
        return $this->conn;
    }
}
