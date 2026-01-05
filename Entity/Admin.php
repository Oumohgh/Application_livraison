<?php

class Admin extends Utilisateur {


     public function __construct(string $nom,string $prenom,string $email,string $password, bool $actif){
        parent::__construct($nom,$prenom, $email, 'admin', "",$actif);
    }
}