<?php
    $servername = "localhost"; //Server URL here if you have a server online!!
    $username = "root";
    $password = "";
    $dbname = "bag-game";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn -> connect_error) {
        die("Connnection failed: " . $conn -> connect_error);
    }
    $conn->set_charset("utf8");

