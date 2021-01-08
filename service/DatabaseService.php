<?php


class DatabaseService extends PDO
{
    public $database;

    public function __construct()
    {
        $this->database = new PDO('mysql:host=localhost;dbname=bb_uebung3', 'root', '');
    }

    // Methode um Datenbank aufzurufen

    public function getDatabase()
    {
        return $this->database;
    }


}







