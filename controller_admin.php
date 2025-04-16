<?php

session_start();

// Configuration d'affichage des erreurs (pour le développement)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifiez si la variable de session 'role' existe et si l'utilisateur est administrateur
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 1) {
        // L'utilisateur est un administrateur, on continue sur cette page
    } else {
        // L'utilisateur n'est pas un administrateur, on le redirige
        header('Location: index.php');
        exit;
    }
} else {
    // La variable de session 'role' n'est pas définie, l'utilisateur n'est pas connecté
    header('Location: index.php'); // Ou une page de connexion
    exit;
}

// Include des fichiers nécessaires
include './utils/functions.php';
include './model/model_hike.php';
include './manager/manager_hike.php';
include './view/header.php';
include './view/view_admin.php';
include './view/footer.php';

// Déclaration et initialisation des variables
$message = '';
$hikeManager = new ManagerHike(); // Renommage pour la cohérence
$unapprovedHikes = $hikeManager->readUnapprovedHikes();

// Traitement de la soumission du formulaire d'approbation
if (isset($_POST['approveHike'])) {
    $id_hike = sanitize($_POST['id_hike']);
    $message = $hikeManager->approveHike($id_hike);
    $unapprovedHikes = $hikeManager->readUnapprovedHikes();
}

$scripts = ['./public/main.js'];
$headerView = new ViewHeader($scripts); // Renommage pour la clarté
$adminView = new ViewAdmin(); // Renommage pour la clarté
$footerView = new ViewFooter(); // Renommage pour la clarté

// Affichage
echo $headerView->render();

// Vérifiez si $unapprovedHikes est un tableau ou une chaîne d'erreur
if (is_array($unapprovedHikes)) {
    $adminView->setMessage($message)->setUnapprovedHikes($unapprovedHikes);
} else {
    // Si c'est une chaîne, c'est un message d'erreur de la base de données
    $adminView->setMessage("Erreur lors de la récupération des randonnées non approuvées : " . $unapprovedHikes)->setUnapprovedHikes([]); // Passer un tableau vide pour éviter l'erreur de type
}

echo $adminView->render();
echo $footerView->render();

?>