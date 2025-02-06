<?php

$param = json_decode(file_get_contents('php://input'));

if (!empty($param)) {
    switch ($param->action) {
        case 'getAllUsername':
            echo json_encode(Permissions::getAllUsername());
            break;
        case 'getAllUser':
            echo json_encode(Permissions::getAllUser());
            break;
        case 'getAllAppname':
            echo json_encode(Permissions::getAllAppname());
            break;
        case 'getAllApp':
            echo json_encode(Permissions::getAllApp());
            break;
        case 'getAllFoldername':
            echo json_encode(Permissions::getAllFoldername());
            break;
        case 'getAllFolder':
            echo json_encode(Permissions::getAllFolder());
            break;
        case 'getAllTypename':
            echo json_encode(Permissions::getAllTypename());
            break;
        case 'getAllType':
            echo json_encode(Permissions::getAllType());
            break;
        case 'getAllAccess':
            echo json_encode(Permissions::getAllAccess());
        case 'insertAccess':
            if (isset($param->username) && isset($param->appname) && isset($param->typename)) {
                Permissions::insertAccess($param->username, $param->appname, $param->typename);
                echo json_encode("Success");
            }
            break;
        case 'updateAccess':
            if (isset($param->username) && isset($param->appname) && isset($param->typename) && isset($param->idAccess)) {
                Permissions::updateAccess($param->username, $param->appname, $param->typename, $param->idAccess);
                echo json_encode("Success");
            }
            break;
        case 'deleteAccess':
            if (isset($param->idAccess)) {
                Permissions::deleteAccess($param->idAccess);
                echo json_encode("Success");
            }
            break;
        case 'duplicateAccess':
            if (isset($param->idAccess) && isset($param->username)) {
                Permissions::duplicateAccess($param->idAccess, $param->username);
                echo json_encode("Success");
            }
            break;
        case 'insertUser':
            if (isset($param->username) && isset($param->agence)) {
                Permissions::insertUser($param->username, $param->agence);
                echo json_encode("Success");
            }
            break;
    }
}
