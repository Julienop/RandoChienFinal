<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$scripts = ['./public/main.js'];
$message = '';
$hike = new ManagerHike();
$pdo = connect();
$stmt = $pdo->query("SELECT id_region, name_region FROM region ORDER BY name_region");
$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
$header = new ViewHeader($scripts);
$addHike = new ViewAddHike();
$addHike->setRegions($regions);
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
        $difficultyString = sanitize($_POST['difficulty']); // Récupérer la difficulté comme une chaîne
        $region = sanitize($_POST['region']);

        // Convertir la chaîne de difficulté en une instance de l'énumération
        try {
            // Assurez-vous que le namespace et le nom de l'énumération sont corrects
            $difficulty = \App\Enum\DifficultyEnum::from($difficultyString);
        } catch (\ValueError $e) {
            $message = "La difficulté sélectionnée n'est pas valide.";
            echo $header->render();
            $addHike->setMessage($message);
            echo $addHike->render();
            echo $footer->render();
            exit; // Arrêter l'exécution du script en cas d'erreur
        }

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