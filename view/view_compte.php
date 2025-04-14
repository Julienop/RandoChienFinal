<?php

class ViewCompte {

    private ?array $userData;

    public function __construct() {
        $this->userData = null;
    }

    public function getUserData(): ?array { return $this->userData; }
    public function setUserData(?array $userData): self { $this->userData = $userData; return $this; }

    public function render(): string {
        ob_start();
        if ($this->userData) {
            ?>
            <main class="formulaires">
                <section>
                    <h1>Compte Utilisateur</h1>
                    <p><strong>Nom :</strong> <?php echo $this->userData['name_rider']; ?></p>
                    <p><strong>Prénom :</strong> <?php echo $this->userData['firstname_rider']; ?></p>
                    <p><strong>Email :</strong> <?php echo $this->userData['email_rider']; ?></p>
                    
                    <!-- Formulaire de déconnexion -->
                    <form action="controller_compte.php" method="post">
                        <input type="submit" name="submitDeconnexion" value="Déconnexion" class="button">
                    </form>
                </section>
            </main>
            <?php
        } else {
            ?>
            <main class="compte">
                <section>
                    <h1>Compte Utilisateur</h1>
                    <p>Aucune information utilisateur disponible.</p>
                </section>
            </main>
            <?php
        }
        return ob_get_clean();
    }

}
?>
