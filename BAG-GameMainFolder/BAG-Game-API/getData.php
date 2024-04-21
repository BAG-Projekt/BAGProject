<?php
    require_once './databaseConnect.php';
    $usersName = $_POST["userName"];
    
    $sql = "SELECT `score1`, `score2` FROM `users` WHERE name = '". $usersName ."';";
    $result = $conn->query($sql);
    $users = [];
    
    while($row = mysqli_fetch_array($result))
      {
        $users[] = array(
            "score1" => $row["score1"],
            "score2" => $row["score2"]
        );
       }
    echo json_encode($users);

