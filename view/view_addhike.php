<?php

class ViewAddHike {

    private ?string $message;

    public function __construct() {
        $this->message = '';
    }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function render(): string {
        ob_start();
        ?>
        <main class="formulaires">
            <section>
                <h1>Ajouter une Randonnée</h1>
                <form action="" method="post">
                    <label>Nom de la randonnée :</label>
                    <input type="text" name="name_hike" size="35" placeholder="Nom de la randonnée"><br>
                    <label>Description :</label>
                    <textarea name="description_hike" rows="4" cols="37" placeholder="Description de la randonnée"></textarea><br>
                    <label>Longueur (km) :</label>
                    <input type="text" name="length" size="35" placeholder="Longueur en kilomètres"><br>
                    <label>Difficulté :</label>
                    <input type="text" name="difficulty" size="35" placeholder="Difficulté (facile, moyen, difficile)"><br>
                    <label>Région :</label>
                    <input type="text" name="region" size="35" placeholder="Région"><br>
                    <input type="submit" name="submitHike" value="Soumettre" class="button">
                </form>
            </section>
            <h2><?php echo $this->getMessage() ?></h2>
        </main>
        <?php return ob_get_clean();
    }
}
?>
