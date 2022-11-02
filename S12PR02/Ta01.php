<?php

class singleton
{
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "";

    private function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new singleton();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
    public function checkConnection()
    {
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            echo "Connected successfully";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR02</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
  <h1>PRÀCTICA 2 PHP</h1>
    <form action="Ta01.php" method="post">
        <p>Escull una opció:</p>
        <select name="menu">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["Database"] . "'>" . $row["Database"] . "</option>";
            }
        } else {
            echo "0 results";
        }

        ?>
        </select>
        <input type="submit" value="Submit">
        <?php
        if($_POST){
            if ("menu"==1){
                $db = "northwind1";
                $conn = singleton::getInstance()->getConnection();
                if ("menu"==2){
                    $db = "world";
                    $conn = singleton::getInstance()->getConnection();
                     if ("menu" == 3){
                        $db = "eco";
                        $conn = singleton::getInstance()->getConnection();
            }
            }
            }
        }
        ?>
        <br>
        <br>
        <p> Sentència SQL: </p>
        <textarea name="text" rows="1" cols="50"></textarea>
        <input type="submit" value="Submit">
        <?php
        if ($_POST) {
            //$menu = $_POST["menu"];
            $text = $_POST["text"];
            if ($text != "") {
            }
        }
        ?>
        <br>
        <br>
        <textarea name = "result" rows = "10" cols = "50">
        <?php
        //display the result
        if ($_POST){
            $text = $_POST["text"];
            $menu = $_POST["menu"];
            if ($text != ""){
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"]. "<br>";
                    }
                } else {
                    echo "0 results";
                }
            }
        }
        ?>
</body>
</html>