<?php

namespace App\Models;

use App\Core\Model;

class Offre extends Model
{
    protected string $table = 'offres';

    public int $id;
    public int $commande_id;
    public int $livreur_id;
    public float $prix;
    public int $duree;

    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO offres (commande_id, livreur_id, prix, duree)
             VALUES (:commande_id, :livreur_id, :prix, :duree)"
        );

        return $stmt->execute([
            'commande_id' => $this->commande_id,
            'livreur_id'  => $this->livreur_id,
            'prix'        => $this->prix,
            'duree'       => $this->duree
        ]);
    }
}