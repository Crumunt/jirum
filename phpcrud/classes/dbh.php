<?php

class Dbh {

    private $dbh;

    protected function connect() {

        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db_name = "studentdb";

            $this->dbh = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);

            return $this->dbh;

        } catch (PDOException $e) {
            
            die("Error: " . $e->getMessage() . "<br>");

        }

    }

}