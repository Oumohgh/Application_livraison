<?php


class Client extends Utilisateur {
    private array $notifications  = [];
    private array $commandes = [];

    public function __construct(string $nom,string $prenom,string $email,string $password, bool $actif){
        parent::__construct($nom,$prenom, $email, 'client', $actif);
    }

    // les actions  Client

}