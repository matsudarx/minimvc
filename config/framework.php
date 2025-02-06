<?php

// Générer les dossiers pour une nouvelle application :
// php framework.php new exemple
// Supprimer les dossiers d'une application :
// php framework.php del exemple 
// TODO : Ajouter à la base de données des infos de l'app (nom, dossier, etc.) automatiquement
if ($argv[1] == 'new') {
    mkdir('../assets/js/' . $argv[2]);
    mkdir('../assets/css/' . $argv[2]);
    mkdir('../src/controllers/' . $argv[2]);
    mkdir('../src/views/' . $argv[2]);
    file_put_contents('../assets/js/' . $argv[2] . '/script.js', '');
    file_put_contents('../assets/css/' . $argv[2] . '/style.css', '');
    file_put_contents('../src/controllers/' . $argv[2] . '/controller.php', "<?php \n");
    file_put_contents('../src/views/' . $argv[2] . '/view.php', '');
} else if ($argv[1] == 'del') {
    array_map('unlink', glob('../assets/js/' . $argv[2] . '/*.*'));
    array_map('unlink', glob('../assets/css/' . $argv[2] . '/*.*'));
    array_map('unlink', glob('../src/controllers/' . $argv[2] . '/*.*'));
    array_map('unlink', glob('../src/views/' . $argv[2] . '/*.*'));
    rmdir('../assets/js/' . $argv[2]);
    rmdir('../assets/css/' . $argv[2]);
    rmdir('../src/controllers/' . $argv[2]);
    rmdir('../src/views/' . $argv[2]);
}
