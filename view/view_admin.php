<?php

class ViewAdmin {

    private ?string $message;
    private array $unapprovedHikes;

    public function __construct() {
        $this->message = '';
        $this->unapprovedHikes = [];
    }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function getUnapprovedHikes(): array { return $this->unapprovedHikes; }
    public function setUnapprovedHikes(array $unapprovedHikes): self { $this->unapprovedHikes = $unapprovedHikes; return $this; }

    public function render(): string {
        ob_start();
        ?>
        <main class="formulaires">
            <section>
                <h1>Validation des Randonnées</h1>
                <?php if (!empty($this->getUnapprovedHikes())): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Longueur (km)</th>
                                <th>Difficulté</th>
                                <th>Région</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->getUnapprovedHikes() as $hike): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($hike['name_hike']); ?></td>
                                    <td><?php echo htmlspecialchars($hike['description_hike']); ?></td>
                                    <td><?php echo htmlspecialchars($hike['length']); ?></td>
                                    <td><?php echo htmlspecialchars($hike['difficulty']); ?></td>
                                    <td><?php echo htmlspecialchars($hike['region']); ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_hike" value="<?php echo htmlspecialchars($hike['id_hike']); ?>">
                                            <input type="submit" name="approveHike" value="Approuver" class="button">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucune randonnée en attente de validation.</p>
                <?php endif; ?>
            </section>
            <h2><?php echo $this->getMessage() ?></h2>
        </main>
        <?php return ob_get_clean();
    }
}
?>
