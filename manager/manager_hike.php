<?php

class ManagerHike extends ModelHike {

    public function readAllHikes(): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT h.id_hike, h.name_hike, h.description_hike, 
            h.length, h.difficulty, r.name_region as region FROM hike h INNER JOIN region r ON h.id_region = r.id_region WHERE h.approved = TRUE');
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }    
    public function readHikesByRegion($regionName): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT h.id_hike, h.name_hike, h.description_hike, 
            h.length, h.difficulty, r.name_region AS region FROM hike h INNER JOIN region r ON h.id_region = r.id_region WHERE r.name_region = ? AND h.approved = TRUE');
            $req->execute([$regionName]);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function createHike() {
        try {
            $req = $this->getBDD()->prepare('
                INSERT INTO hike (name_hike, description_hike,
                length, difficulty, id_region, approved)
                VALUES (?, ?, ?, ?, ?, FALSE)
            ');
            // Récupérer la valeur (string) de l'énumération difficulty
            $difficultyValue = $this->getDifficulty()->value;
            $req->execute([$this->getNameHike(), $this->getDescriptionHike(),
            $this->getLength(), $difficultyValue, $this->getRegion()]);
            return "Randonnée soumise avec succès pour approbation !";
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function readHikeByName(): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT h.*, r.name_region AS region FROM hike h INNER JOIN region r ON h.id_region = r.id_region WHERE h.name_hike = ?');
            $req->execute([$this->getNameHike()]);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function readUnapprovedHikes(): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT h.id_hike, h.name_hike, h.description_hike, 
            h.length, h.difficulty, r.name_region AS region FROM hike h INNER JOIN region r ON h.id_region = r.id_region WHERE h.approved = FALSE');
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function approveHike($id_hike) {
        try {
            $req = $this->getBDD()->prepare('UPDATE hike SET approved = TRUE WHERE id_hike = ?');
            $req->execute([$id_hike]);
            return "Randonnée approuvée avec succès !";
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }
}
?>
