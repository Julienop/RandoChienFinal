<?php
    
class ViewConnexion {
    
    private ?string $message;

    public function __construct() {
        $this->message = '';
    }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function render():string{   
        ob_start();
        ?>
        <main class="formulaires">
        
            <section>
                <h1>Nouvel Utilisateur</h1>
                <form action="" method="post">
                    <label>Nom :</label>
                    <input type="text" name="name" size="35" placeholder="Votre Nom"><br>
                    <label>Prénom :</label>
                    <input type="text" name="firstname" size="35" placeholder="Votre Prénom"><br>
                    <label>Email :</label>
                    <input type="text" name="email" size="35" placeholder="Votre Email"><br>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" size="35" placeholder="Votre Mot de Passe"><br>
                    <label>Mot de passe :</label>
                    <input type="password" name="passwordVerify" size="35" placeholder="Retappez votre Mot de Passe"><br>
                    <input type="submit" name="submitInscription" value="S'inscrire" class="button">
                </form>
            </section>
            <h2><?php echo $this->getMessage() ?></h2>
            <section>
                <h1>Connexion</h1>
                <form action="" method="post">
                    <label>Email :</label>
                    <input type="text" name="email" size="35" placeholder="Votre Email"><br>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" size="35" placeholder="Votre Mot de Passe"><br>
                    <input type="submit" name="submitConnexion" value="Se connecter" class="button">
                </form>
            </section>

            

        </main>
        <?php return ob_get_clean();
        }

}
?>