<?php

class Livreur extends Utilisateur {
    private array $offres = [];
    private array $notifications = [];


     public function __construct(string $nom,string $prenom,string $email,string $password, bool $actif){
        parent::__construct($nom,$prenom, $email, 'livreur', $actif);
    } 
    // les actions Livreuer


}