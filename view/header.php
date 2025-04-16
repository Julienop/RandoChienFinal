<?php

class ViewHeader{

    private $scripts;

    public function __construct($scripts) {
        $this->scripts = $scripts;
    }

public function render():string{
    ob_start();
    ?>
    <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Rando-Chien.fr - Accueil</title>
                <link rel="stylesheet" href="./public/style.css">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Underdog&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Neuton:ital,wght@0,200;0,300;0,400;0,700;0,800;1,400&display=swap" rel="stylesheet">
                <?php foreach ($this->scripts as $script) : ?>
                    <script src="<?php echo $script; ?>" defer></script>
                <?php endforeach; ?>

            </head>
            <body>
                
            <div class="wrapper">
                <header>
                    
                    <div id="header2">
                    
                        <a href="index.php"><img id="logo" src="./public/logo/logo.svg" alt="LOGO" title="Accueil"></a>

                        <div id="header3">

                            <h3 id="citation">

                            </h3>

                            <menu>
                                <a href="controller_hike.php"><input type="button" value="Nos randonnées" class="button"></a>
                                <a href="<?php echo isset($_SESSION['email']) ? 'controller_add_hike.php' : 'controller_connexion.php'; ?>"><input type="button" value="Proposer une randonnée" class="button"></a>
                                <input type="button" value="Nos conseils" class="button">
                                <a href="controller_info.php"><input type="button" value="Nous connaître" class="button"></a>
                                <a href="<?php echo isset($_SESSION['email']) ? 'controller_compte.php' : 'controller_connexion.php'; ?>"><input type="button" value="Mon profil" class="button"></a>
                            </menu>

                        </div>

                        <nav class="navbar">
                            <div class="burger" id="burger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <ul class="nav-links" id="nav-links">
                                <button class="close-btn" id="close-btn">&times;</button>
                                <li><a href="controller_hike.php">Nos randonnées</a></li>
                                <li><a href="<?php echo isset($_SESSION['email']) ? 'controller_add_hike.php' : 'controller_connexion.php'; ?>">Proposer une randonnée</a></li>
                                <li><a href="#services">Nos conseils</a></li>
                                <li><a href="controller_info.php">Nous connaître</a></li>
                                <li><a href="<?php echo isset($_SESSION['email']) ? 'controller_compte.php' : 'controller_connexion.php'; ?>">Mon profil</a></li>
                            </ul>
                        </nav>

                    </div>

                        <div id="arianeSearch">
                        <?php
                            // Récupération de la page actuelle
                            $current_page = basename($_SERVER['SCRIPT_NAME']);

                            // Tableau des pages avec leurs noms affichés dans le fil d'Ariane
                            $breadcrumbs = [
                                "index.php" => "Accueil",
                                "controller_hike.php" => "Randonnées",
                                "controller_add_hike.php" => "Proposer une randonnée",
                                "controller_connexion.php" => "Connexion",
                                "controller_compte.php" => "Mon Profil",
                                "controller_info.php" => "Nous connaître",
                                "controller_admin.php" => "Admin",
                            ];

                            // Génération dynamique du fil d'Ariane
                            echo '<nav aria-label="fil d\'ariane" class="ariane"><ul>';
                            echo '<li><a href="index.php">Accueil</a></li>';

                            if ($current_page !== "index.php" && isset($breadcrumbs[$current_page])) {
                                echo '<li><span>' . $breadcrumbs[$current_page] . '</span></li>';
                            }

                            echo '</ul></nav>';
                            ?>

                        <input id="search" type="search" placeholder="Recherche">

                        </div>

                    </div>
                </header>
                <?php return ob_get_clean();
    }
}
?> 