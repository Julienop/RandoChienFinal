<?php

class ViewInfo {

    public function render(): string {
        ob_start();
        ?>
        <main class="formulaires">
            <section>
                <h1>À propos de mon site</h1>
                <p>Bienvenue sur Rando-Chien, le site qui permet de randonnée avec son animal de compagnie en toute quiétude !</p>
                <p>Ce site a été réalisé dans le cadre de ma formation de web developper à l'ADRAR.</p>
                <p>J'ai essayé d'y inclure le maximum de connaissances que j'ai vu lors de cette formation.</p>
                <p>Je profite de cette page pour remercier tous les formidables formateurs qui m'ont accompagné lors de cette belle aventure :</p>
                <ul id="formateurs">
                    <li>Mathieu M.</li>
                    <li>Mathieu P.</li>
                    <li>Yohann</li>
                    <li>Bastien</li>
                    <li>Sophie</li>
                    <li>Jeff</li>
                    <li>Yann</li>
                    <li>Thimotée</li>
                    <li>Julien</li>
                    <li>Pierre</li>
                    <li>Lady Catherine</li>
                    <li>Marie</li>
                    <li>Laëtitia</li>
                    <li>Jérôme</li>
                </ul>
            </section>
        </main>
        <?php
        return ob_get_clean();
    }
}
?>
