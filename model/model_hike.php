<?php

use App\Enum\DifficultyEnum;
use Doctrine\ORM\Mapping as ORM;

class ModelHike {

    private $id_hike;
    private $name_hike;
    private $description_hike;
    private $length;
    #[ORM\Column(type: "string", enumType: DifficultyEnum::class)]
    private DifficultyEnum $difficulty;
    private $region;
    private ?PDO $bdd;

    public function __construct() {
        // Initialisation de la connexion à la base de données
        $this->bdd = connect();
    }

    public function getBDD() {
        return $this->bdd;
    }

    // Getter et setter pour chaque attribut

    public function getIdHike() {
        return $this->id_hike;
    }

    public function setIdHike($id_hike) {
        $this->id_hike = $id_hike;
        return $this;
    }

    public function getNameHike() {
        return $this->name_hike;
    }

    public function setNameHike($name_hike) {
        $this->name_hike = $name_hike;
        return $this;
    }

    public function getDescriptionHike() {
        return $this->description_hike;
    }

    public function setDescriptionHike($description_hike) {
        $this->description_hike = $description_hike;
        return $this;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
        return $this;
    }

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function setDifficulty(DifficultyEnum $difficulty): self {
    $this->difficulty = $difficulty;
    return $this;
    }
    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;
        return $this;
    }
}
?>
