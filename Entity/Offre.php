<?php

class Offre {
    private int $idOffre;
    private string $prixOffre;
    private string $optionOffre;
    private string $typeVehicule;

    public function __construct(int $idOffre, string $prixOffre, string $optionOffre, string $typeVehicule){
        $this->idOffre = $idOffre;
        $this->prixOffre = $prixOffre;
        $this->optionOffre = $optionOffre;
        $this->typeVehicule = $typeVehicule;
    }

    
}