<?php

class ModelUser {
    //ATTRIBUTS
    private ?int $id;
    private ?string $name;
    private ?string $firstname;
    private ?string $email;
    private ?string $password;
    private ?int $role = 2;
    private ?PDO $bdd;

    //CONSTRUCTEUR
    public function __construct() {
        $this->bdd = connect();
    }
    //GETTER
    public function getId():?int {
        return $this->id;
    }
    public function getName():?string {
        return $this->name;
    }
    public function getFirstname():?string {
        return $this->firstname;
    }
    public function getEmail():?string {
        return $this->email;
    }
    public function getPassword():?string {
        return $this->password;
    }
    public function getRole():?int {
        return $this->role;
    }
    public function getBdd():?PDO{
        return $this->bdd;
    }
    //SETTER
    public function setId(int $newId):?ModelUser{
        $this->id = $newId;
        return $this;
    }
    public function setName(string $newName):?ModelUser{
        $this->name = $newName;
        return $this;
    }
    public function setFirstname(string $newFirstname):?ModelUser{
        $this->firstname = $newFirstname;
        return $this;
    }
    public function setEmail(string $newEmail):?ModelUser{
        $this->email = $newEmail;
        return $this;
    }
    public function setPassword(string $newPassword):?ModelUser{
        $this->password = $newPassword;
        return $this;
    }
    public function setRole(int $newRole):?ModelUser{
        $this->role = $newRole;
        return $this;
    }
    public function setBDD(?PDO $newBDD):?ModelUser{
        $this->bdd = $newBDD;
        return $this;
    }
}

?>