<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($_SESSION['username'])) {
            echo Permissions::fromCamelcase($_GET['app']) . ' - ';
        }
        if ($_SERVER['SERVER_PORT'] == '443') {
            echo $_SERVER['SERVER_NAME'];
        } else {
            echo $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        }
        ?>
    </title>
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" /> -->
    <!--preload-->
    <link rel="preload" href="assets/js/lib/node_modules/bootstrap/dist/css/bootstrap.min.css" as="style" />
    <link rel="preload" href="assets/js/lib/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" as="script" />
    <link rel="preload" href="assets/js/lib/node_modules/bootstrap-icons/font/bootstrap-icons.min.css" as="style" />
    <link rel="preload" href="assets/js/lib/node_modules/ag-grid-community/styles/ag-grid.min.css" as="style" />
    <link rel="preload" href="assets/js/lib/node_modules/ag-grid-community/styles/ag-theme-quartz.min.css" as="style" />
    <link rel="preload" href="assets/js/lib/node_modules/ag-grid-community/dist/ag-grid-community.min.noStyle.js"
        as="script" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/js/lib/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script src="assets/js/lib/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="assets/js/lib/node_modules/bootstrap-icons/font/bootstrap-icons.min.css" />
    <!-- ag-grid-enterprise -->
    <link rel="stylesheet" href="assets/js/lib/node_modules/ag-grid-community/styles/ag-grid.min.css" />
    <link rel="stylesheet" href="assets/js/lib/node_modules/ag-grid-community/styles/ag-theme-quartz.min.css" />
    <script src="assets/js/lib/node_modules/ag-grid-community/dist/ag-grid-community.min.noStyle.js" defer></script>
    <!-- app -->