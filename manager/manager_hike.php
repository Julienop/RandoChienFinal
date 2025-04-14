<?php

class ManagerHike extends ModelHike {

    public function readAllHikes(): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT id_hike, name_hike, description_hike, length, difficulty, region FROM hike WHERE approved = TRUE');
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }    
    public function readHikesByRegion($region): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT id_hike, name_hike, description_hike, length, difficulty, region FROM hike WHERE region = ? AND approved = TRUE');
            $req->execute([$region]);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function createHike() {
        try {
            $req = $this->getBDD()->prepare('INSERT INTO hike (name_hike, description_hike, length, difficulty, region, approved) VALUES (?, ?, ?, ?, ?, FALSE)');
            $req->execute([$this->getNameHike(), $this->getDescriptionHike(), $this->getLength(), $this->getDifficulty(), $this->getRegion()]);
            return "Randonnée soumise avec succès pour approbation !";
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function readHikeByName(): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT * FROM hike WHERE name_hike = ?');
            $req->execute([$this->getNameHike()]);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }

    public function readUnapprovedHikes(): array | string {
        try {
            $req = $this->getBDD()->prepare('SELECT id_hike, name_hike, description_hike, length, difficulty, region FROM hike WHERE approved = FALSE');
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
