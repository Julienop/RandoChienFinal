<?php
session_start();

// Include de mon fichier de fonctions utilitaires
include './utils/functions.php';

// Include de mon modèle
include './model/model_hike.php';
include './manager/manager_hike.php';

// Include de mon affichage
include './view/header.php';
include './view/view_hike.php';
include './view/footer.php';

// Déclaration des variables d'affichage
$scripts = ['./src/main.js'];
$hikeManager = new ManagerHike();
$header = new ViewHeader($scripts);
$hikeView = new ViewHike();
$footer = new ViewFooter();

if (isset($_GET['region'])) {
    $region = sanitize($_GET['region']);
    $hikes = $hikeManager->readHikesByRegion($region);
} else {
    // Si la région n'est pas spécifiée, récupérez toutes les randonnées
    $hikes = $hikeManager->readAllHikes();
}

$hikeView->setHikes($hikes);

echo $header->render();
echo $hikeView->render();
echo $footer->render();
?>
