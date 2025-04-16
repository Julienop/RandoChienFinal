<?php
session_start();

// Include de mon fichier de fonctions utilitaires
include './utils/functions.php';

// Include de mon affichage
include './view/header.php';
include './view/view_info.php';
include './view/footer.php';

// Déclaration des variables d'affichage
$scripts = ['./public/main.js'];
$header = new ViewHeader($scripts);
$info = new ViewInfo();
$footer = new ViewFooter();

echo $header->render();
echo $info->render();
echo $footer->render();
?>
