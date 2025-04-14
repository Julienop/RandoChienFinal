<?php

session_start();

// Include de mon fichier de fonctions utilitaires
include './utils/functions.php';

// Include de mon modèle
include './model/model_users.php';
include './manager/manager_users.php';

// Include de mon affichage
include './view/header.php';
include './view/view_compte.php';
include './view/footer.php';

// Déclaration des variables d'affichage
$scripts = ['./src/main.js'];
$user = new ManagerUser();
$header = new ViewHeader($scripts);
$compte = new ViewCompte();
$footer = new ViewFooter();

// Gestion de la déconnexion
if (isset($_POST['submitDeconnexion'])) {
    session_unset();
    session_destroy();
    header('Location:controller_connexion.php');
    exit;
}

if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
    $user->setEmail($_SESSION['email']);
    $data = $user->readUserByMail();
    $compte->setUserData($data[0]);
}else{
    header('Location:controller_connexion.php');
    exit;
}

echo $header->render();
echo $compte->render();
echo $footer->render();

?>
