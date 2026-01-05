<?php


class Commande {
    private int $idCommande;
    private string $titreCommande;
    private string  $descriptionCommande;
    private string $AdresseDepart;
    private string $AdresseArrive;
    private string $statut;
    private bool $isDelete = false;
    // 
    private array $offres = [];

    public function __construct(
        int $idCommande, string $titreCommande, string $descriptionCommande,
        string $AdresseDepart, string $AdresseArrive)
        {
            $this->idCommande = $idCommande;
            $this->titreCommande = $titreCommande;
            $this->descriptionCommande = $descriptionCommande;
            $this->AdresseDepart = $AdresseDepart;
            $this->AdresseArrive = $AdresseArrive;
            $this->statut = 'cree';
        }

        public function getIdCommande(){ return $this->idCommande; }

        public function getTitreCommande(){ return $this->titreCommande; }

        public function getAddresseDepart() { return $this->AdresseDepart; }
        public function getAdresseArrive() { return $this->AdresseArrive; }

        public function getStatut() { return $this->statut; }
        //  actions de commande
}