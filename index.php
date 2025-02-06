<?php

require_once "lib/autoload.php";

session_start();

$param = json_decode(file_get_contents('php://input'));

if (!empty($_SERVER['argv'])) {
    // Interraction avec un cron
    require_once "src/controllers/" . $_SERVER['argv'][1] . "/cron.php";
} else if (!empty($param)) {
    // Interraction avec une app
    if (in_array($param->app, ['login', 'navbar', 'accueil']) || Permissions::isAccessible($param->app, $_SESSION['username'])) {
        require_once "src/controllers/" . $param->app . "/controller.php";
    }
} else {
    // Charger l'interface d'une app
    if (!isset($_SESSION['username'])) {
        require_once "config/headerBegin.php";
        echo '<link rel="stylesheet" href="assets/css/login/style.css" />';
        echo '<script src="assets/js/login/script.js" defer></script>';
        require_once "config/headerEnd.php";
        require_once "src/views/login/view.php";
    } else {
        if (isset($_GET['app']) && $_GET['app'] !== '') {
            if ($_GET['app'] == 'login') {
                header('Location: index.php?app=accueil');
                exit;
            } else {
                if (in_array($_GET['app'], ['login', 'accueil']) || Permissions::isAccessible($_GET['app'], $_SESSION['username'])) {
                    require_once "config/headerBegin.php";
                    echo '<link rel="stylesheet" href="assets/css/navbar/style.css" />';
                    echo '<script src="assets/js/navbar/script.js" defer></script>';
                    echo '<link rel="stylesheet" href="assets/css/' . $_GET['app'] . '/style.css" />';
                    echo '<script src="assets/js/' . $_GET['app'] . '/script.js" defer></script>';
                    require_once "config/headerEnd.php";
                    require_once "src/views/navbar/view.php";
                    require_once "src/views/" . $_GET['app'] . "/view.php";
                }
            }
        } else {
            header('Location: index.php?app=accueil');
            exit;
        }
    }
    require_once "config/footer.php";
}