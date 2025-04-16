<?php
session_start();

// //Include de mon fichier de fonctions utilitaires
include './utils/functions.php';

// //Include de mon modèle
include './model/model_users.php';
include './model/model_hike.php';
include './manager/manager_users.php';
include './manager/manager_hike.php';

// //Include de mon affichage
include './view/header.php';
include './view/view_accueil.php';
include './view/footer.php';

// //Déclaration des variables d'affichage
$scripts = ['./public/main.js','./public/map.js'];
$message = '';
$hikes = [];
$hikeManager = new ManagerHike();
$user = new ManagerUser();
$header = new ViewHeader($scripts);
$accueil = new ViewAccueil();
$footer = new ViewFooter();

// //Vérification de l'URL si région séléctionnée
if (isset($_GET['region'])) {
    $region = sanitize($_GET['region']);
    $hikes = $hikeManager->readHikesByRegion($region);
}

// //Appel des vues
echo $header->render();
echo $accueil->setHikes($hikes)->render();
echo $footer->render();
?>