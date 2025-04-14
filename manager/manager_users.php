<?php
class ManagerUser extends ModelUser {

    public function readUserByMail(): array | string {
        try{
            //Préparation de ma requête SELECT
            $req = $this->getBDD()->prepare('SELECT id_rider, name_rider, firstname_rider, email_rider, password_rider, id_role FROM rider WHERE email_rider = ? LIMIT 1');
    
            $email = $this->getEmail();
            //Binding de Param :
            $req->bindParam(1,$email,PDO::PARAM_STR);
    
            //Exécuter la requête
            $req->execute();
    
            //Récupération de la réponse de la BDD
            $data = $req->fetchAll();
    
            return $data;
    
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }
    public function readUsers(): array | string {
        try{
            //Requete préparé
            $req = $this->getBDD()->prepare('SELECT id_rider, name_rider, firstname_rider, email_rider, password_rider, id_role FROM rider');
    
            //Exécution de la requête
            $req->execute();
    
            //Récupérer la réponse de la bdd : je reçois un tableau contenant des tableaux d'utilisateurs
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $data;
    
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }
    
    public function createUser(): string {
        try{
            //Prepare notre requête d'INSERT
            $req = $this->getBDD()->prepare('INSERT INTO rider 
            (name_rider, firstname_rider, email_rider, password_rider, id_role) 
            VALUES (?,?,?,?,?)');
    
            $name = $this->getName();
            $firstname = $this->getFirstname();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $role = $this->getRole();
    
            //Binding de Param :
            $req->bindParam(1,$name,PDO::PARAM_STR);
            $req->bindParam(2,$firstname,PDO::PARAM_STR);
            $req->bindParam(3,$email,PDO::PARAM_STR);
            $req->bindParam(4,$password,PDO::PARAM_STR);
            $req->bindParam(5,$role,PDO::PARAM_INT);
    
            //Exécution de la requête
            $req->execute();
    
            return "$firstname $name a été enregistré avec succès !";
    
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }
    
    public function updateUser(): string {
        try{
            //Prepare notre requête d'INSERT
            $req = $this->getBDD()->prepare('UPDATE rider SET name_rider = ?, firstname_rider = ?, email_rider = ?, password_rider = ?, `role` = ? WHERE id_rider = ?');
    
            $id = $this->getId();
            $name = $this->getName();
            $firstname = $this->getFirstname();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $role = $this->getRole();
    
           //Binding de Param :
            $req->bindParam(1,$name,PDO::PARAM_STR);
            $req->bindParam(2,$firstname,PDO::PARAM_STR);
            $req->bindParam(3,$email,PDO::PARAM_STR);
            $req->bindParam(4,$password,PDO::PARAM_STR);
            $req->bindParam(5,$role,PDO::PARAM_INT);
            $req->bindParam(6,$id,PDO::PARAM_INT);
    
            //Exécution de la requête
            //Exécuter la requête
            $req->execute();
    
            return "Le randonneur a été modifié avec succès !";
    
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }

    public function readRoleByIdRider($id_rider) {
        try {
            $req = $this->getBDD()->prepare('SELECT label FROM role WHERE id_rider = ?');
            $req->execute([$id_rider]);
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (EXCEPTION $error) {
            return $error->getMessage();
        }
    }
    


}








?>