<?php
    require_once './databaseConnect.php';
    $loginName = $_POST["loginName"];
    $loginPass = $_POST["loginPass"];
    
    $hassedPass = "";
    
    $sql = "SELECT password FROM `users` WHERE name = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $loginName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $hassedPass = $row["password"];

        if(password_verify($loginPass, $hassedPass))
        {
            echo '001';
        }
        else
        {
            echo '002';
        }     
    }
    else
    {
        echo '004';
    }

