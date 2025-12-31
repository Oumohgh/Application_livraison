<?php 

class Commande {

     protected  $id;
    protected $dateCreation;
    protected $statut;
    protected $adresseLivraison;

     public function __construct($dateCreation,  $adresseLivraison,$statut ) {
        $this-> dateCreation= $dateCreation;
        $this->adresseLivraison = $adresseLivraison;
        $this->statut= $statut;
    }

    
        public function setdateCreation($dataCreation){
         $this->dateCreation = $dataCreation;
      }
      public function getdateCreation(){
         return $this->dateCreation;
      }

      public function setStatut($statut){
        $this->statut=$statut;
      }

    public function getStatut(){
        return $this->statut;
    }
    public function setadresseLivraison ($adresseLivraison){
        $this-> adresseLivraison = $adresseLivraison;
    }
    public  function getadresseLivraison (){
        return $this ->adresseLivraison;
    }
    
}
