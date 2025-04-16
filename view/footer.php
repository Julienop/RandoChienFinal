<?php
class ViewFooter{
    public function render():string{
        ob_start();
        ?>
        <footer>
                    <div class="lienFooter">
                        <a href="http://google.com/?q=A" class="lien">Mentions légales</a><p class="slash">&emsp;/&emsp;</p>
                        <a href="http://google.com/?q=A" class="lien">CGU</a><p class="slash">&emsp;/&emsp;</p>
                        <a href="http://google.com/?q=A" class="lien">Données personnelles et cookies</a><p class="slash">&emsp;/&emsp;</p>
                        <a href="http://google.com/?q=A" class="lien">Contact</a><p class="slash">&emsp;/&emsp;</p>
                        <a href="http://google.com/?q=A" class="lien">Nos valeurs</a><p class="slash">&emsp;/&emsp;</p>
                        <a href="http://google.com/?q=A" class="lien">FAQ</a>
                    </div>
                    <div class="iconeFooter">
                        <a href="https://facebook.com" target="_blank"><img class="icone" src="./public/logo/fb.png" alt="Facebook" title="Facebook"></a>
                        <a href="https://instagram.com" target="_blank"><img class="icone" src="./public/logo/ig.png" alt="Instagram" title="Instagram"></a>
                        <a href="https://twitter.com" target="_blank"><img class="icone" src="./public/logo/tw.png" alt="X" title="X"></a>
                    </div>

                </footer>
                </div>
        </body>
    </html>
    <?php return ob_get_clean();
    }
}
?>