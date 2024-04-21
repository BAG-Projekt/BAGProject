<?php
    require_once './databaseConnect.php';
    
    $sql = "SELECT name, score1, score2 FROM users ORDER BY score1 AND score2 DESC";
    $result = $conn->query($sql);
    $users = [];
    
    while($row = mysqli_fetch_array($result))
      {
        $users[] = array(
          "name" => $row["name"],
          "score1" => $row["score1"],
          "score2" => $row["score2"]
        );
       }
    echo json_encode($users);
