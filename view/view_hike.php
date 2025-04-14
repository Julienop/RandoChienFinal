<?php

class ViewHike {

    private ?array $hikes;

    public function __construct() {
        $this->hikes = [];
    }

    public function getHikes(): ?array { return $this->hikes; }
    public function setHikes(?array $hikes): self { $this->hikes = $hikes; return $this; }

    public function render(): string {
        ob_start();
        ?>
        <main class="formulaires">
            <section>
                <h1>Liste des Randonnées</h1>
                <?php if (!empty($this->hikes)): ?>
                    <ul>
                        <?php foreach ($this->hikes as $hike): ?>
                            <li>
                                <h2><?php echo $hike['name_hike']; ?></h2>
                                <p><strong>Description :</strong> <?php echo $hike['description_hike']; ?></p>
                                <p><strong>Longueur :</strong> <?php echo $hike['length']; ?> km</p>
                                <p><strong>Difficulté :</strong> <?php echo $hike['difficulty']; ?></p>
                                <p><strong>Région :</strong> <?php echo $hike['region']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucune randonnée disponible.</p>
                <?php endif; ?>
            </section>
        </main>
        <?php
        return ob_get_clean();
    }

}
?>
