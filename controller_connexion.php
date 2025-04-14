<?php

session_start();

// Include de mon fichier de fonctions utilitaires
include './utils/functions.php';

// Include de mon modèle
include './model/model_users.php';
include './manager/manager_users.php';

// INCLUDE DE MON AFFICHAGE
include './view/header.php';
include './view/view_connexion.php';
include './view/footer.php';

// DECLARATION DES VARIABLES D'AFFICHAGES
$scripts = ['./src/main.js'];
$message = '';
$user = new ManagerUser();
$header = new ViewHeader($scripts);
$connexion = new ViewConnexion();
$footer = new ViewFooter();

// INSCRIPTION D'UN UTILISATEUR
if (isset($_POST['submitInscription'])) {
    // Vérifie que les données ne sont pas vides
    if (isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['firstname']) && !empty($_POST['firstname']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password']) &&
        isset($_POST['passwordVerify']) && !empty($_POST['passwordVerify'])
    ) 
        // Vérifier que le mail est au bon format
        {if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            // Vérifie que les 2 mots de passe correspondent
            if ($_POST['password'] === $_POST['passwordVerify']) {

                // Nettoyage des données
                $name = sanitize($_POST['name']);
                $firstname = sanitize($_POST['firstname']);
                $email = sanitize($_POST['email']);
                $password = sanitize($_POST['password']);
                $passwordVerify = sanitize($_POST['passwordVerify']);

                // Hasher le mot de passe
                $password = password_hash($password, PASSWORD_BCRYPT);

                // Vérifier si l'utilisateur est déjà enregistré ou pas en BDD
                $user->setName($name)
                    ->setFirstname($firstname)
                    ->setEmail($email)
                    ->setPassword($password);

                $data = $user->readUserByMail();

                // Vérifie si $data est vide, pour savoir si l'email est disponible à l'enregistrement
                if (empty($data)) {

                    // On commence à enregistrer le compte, car l'email est disponible
                    $message = $user->createUser();

                } else {
                    $message = "Cet email est déjà utilisé par un autre compte !";
                }

            } else {
                $message = "Vos deux mots de passe ne correspondent pas !";
            }

        } else {
            $message = "Votre email n'est pas au bon format !";
        }

    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    header('Location:index.php');
    exit;
}

// CONNEXION D'UN UTILISATEUR
if (isset($_POST['submitConnexion'])) {
    // Vérifie que les données ne sont pas vides
    if (
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password'])
    ) {
        // Vérifier que le mail est au bon format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Nettoyage des données
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);

            // Vérifier si l'utilisateur est enregistré en BDD par son email
            $user->setEmail($email);
            $userData = $user->readUserByMail();

            // Vérifie si $userData contient des informations
            if (!empty($userData)) {
                // On vérifie le mot de passe
                if (password_verify($password, $userData[0]['password_rider'])) {
                    // Informations de session
                    $_SESSION['id'] = $userData[0]['id_rider'];
                    $_SESSION['name'] = $userData[0]['name_rider'];
                    $_SESSION['firstname'] = $userData[0]['firstname_rider'];
                    $_SESSION['email'] = $userData[0]['email_rider'];

                    // Vérifier si l'utilisateur est admin en fonction de l'id_role
                    $_SESSION['role'] = $userData[0]['id_role']; // Stockez directement l'id_role

                    header('Location: controller_compte.php');
                    exit;
                } else {
                    $message = "Erreur d'email et/ou mot de passe";
                }
            } else {
                $message = "Erreur d'email et/ou mot de passe";
            }
        } else {
            $message = "Votre email n'est pas au bon format !";
        }
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}

echo $header->render();
$connexion->setMessage($message);
echo $connexion->render();
echo $footer->render();

?>
