<?php
    $request = $_SERVER["QUERY_STRING"];
    $req = explode('/', $request);
    switch ($req[0])
    {
        case "user":
            require_once './getUsers.php';
                break;
        case "login":
        require_once './userLogin.php';
            break;
        case "register":
        require_once './userRegister.php';
            break;
        case "score":
        require_once './updateScore.php';
            break;
        case "data":
        require_once './getData.php';
            break;
        case "updatedata":
        require_once './updateData.php';
            break;
        default:
            http_response_code(404);
            break;
    }