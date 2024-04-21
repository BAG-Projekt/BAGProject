<?php
require_once './databaseConnect.php';
    $loginName = $_POST["loginName"];
    $loginPass = $_POST["loginPass"];
    
    $hassedPass = password_hash($loginPass, PASSWORD_BCRYPT);
    
    $sql = "SELECT name FROM `users` WHERE name = '". $loginName . "'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0)
    {
        echo '002';
    }
    else
    {             
      $sql2 = "INSERT INTO `users`(`name`, `password`) VALUES ('". $loginName ."','". $hassedPass ."')";
      if ($conn->query($sql2) === true)
      {
          echo '001';
      }
      else
      {
          echo '004';
      }
    }

