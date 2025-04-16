<?php

require_once __DIR__ . '/../src/Enum/DifficultyEnum.php';
use App\Enum\DifficultyEnum;

class ViewAddHike {

    private ?string $message;
    private array $regions;

    public function __construct() {
        $this->message = '';
        $this->regions = [];
    }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function getRegions(): array { return $this->regions; }
    public function setRegions(array $regions): self { $this->regions = $regions; return $this; }
    
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
                    <select name="difficulty">
                        <?php foreach (DifficultyEnum::cases() as $case): ?>
                            <option value="<?= $case->value ?>"><?= $case->label() ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <label>Région :</label>
                    <select name="region">
                        <?php foreach ($this->regions as $region): ?>
                            <option value="<?= $region['id_region'] ?>" 
                                <?= (isset($_POST['region']) && $_POST['region'] == $region['id_region']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($region['name_region']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <input type="submit" name="submitHike" value="Soumettre" class="button">
                </form>
            </section>
            <h2><?php echo $this->getMessage() ?></h2>
        </main>
        <?php return ob_get_clean();
    }
}
?>
