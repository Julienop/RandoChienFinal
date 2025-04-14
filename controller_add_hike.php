<?php

session_start();

// Include de mon fichier de fonctions utilitaires
include './utils/functions.php';

// Include de mon modèle et manager existants
include './model/model_hike.php';
include './manager/manager_hike.php';

// Include de mon affichage
include './view/header.php';
include './view/view_addhike.php';
include './view/footer.php';

// Déclaration des variables d'affichages
$scripts = ['./src/main.js'];
$message = '';
$hike = new ManagerHike();
$header = new ViewHeader($scripts);
$addHike = new ViewAddHike();
$footer = new ViewFooter();

// Ajouter une randonnée
if(isset($_POST['submitHike'])){
    if(isset($_POST['name_hike']) && !empty($_POST['name_hike'])
    && isset($_POST['description_hike']) && !empty($_POST['description_hike'])
    && isset($_POST['length']) && !empty($_POST['length'])
    && isset($_POST['difficulty']) && !empty($_POST['difficulty'])
    && isset($_POST['region']) && !empty($_POST['region'])){

        // Nettoyage des données
        $name_hike = sanitize($_POST['name_hike']);
        $description_hike = sanitize($_POST['description_hike']);
        $length = sanitize($_POST['length']);
        $difficulty = sanitize($_POST['difficulty']);
        $region = sanitize($_POST['region']);

        // Vérifier si la randonnée est déjà enregistrée ou pas en BDD
        $hike->setNameHike($name_hike)->setDescriptionHike($description_hike)->setLength($length)->setDifficulty($difficulty)->setRegion($region);

        $data = $hike->readHikeByName();

        // Vérifie si $data est vide, pour savoir si la randonnée est disponible à l'enregistrement
        if(empty($data)){
            // On commence à enregistrer la randonnée
            $message = $hike->createHike();
        } else {
            $message = "Cette randonnée est déjà enregistrée !";
        }

    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}

echo $header->render();
$addHike->setMessage($message);
echo $addHike->render();
echo $footer->render();

?>
