<?php

$param = json_decode(file_get_contents('php://input'));

if (!empty($param)) {
    $action = $param->action;
    switch ($action) {
        case 'login':
            $user = $param->username;
            $password = $param->password;
            $response = ["status" => "success"];
            echo json_encode($response);
            break;
        case 'logout':
            if (session_destroy()) {
                $response = ["status" => "success"];
            } else {
                $response = ["status" => "failed"];
            }
            echo json_encode($response);
            break;
    }
}