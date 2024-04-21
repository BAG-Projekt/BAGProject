<?php
    require_once './databaseConnect.php';
    $usersName = $_POST["userName"];
    $usersScore1 = $_POST["score1"];
    $usersScore2 = $_POST["score2"];

    $sql = "SELECT name FROM `users` WHERE name = '". $usersName ."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0)
    {
      $sql2 = "UPDATE `users` SET `score1`=". $usersScore1 .", `score2`=". $usersScore2 ." WHERE name = '" . $usersName ."'";
      if ($conn->query($sql2) === true)
      {
          echo '001';
      }
      else
      {
          echo '004';
      }               
    }
    else
    {             
      echo '002';
    }
