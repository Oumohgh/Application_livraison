<?php

namespace App\Models;

use App\Core\Model;

class Vehicule extends Model
{
    protected string $table = 'vehicules';

    public int $id;
    public int $livreur_id;
    public string $type;
    public string $matricule;

    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO vehicules (livreur_id, type, matricule)
             VALUES (:livreur_id, :type, :matricule)"
        );

        return $stmt->execute([
            'livreur_id' => $this->livreur_id,
            'type'       => $this->type,
            'matricule'  => $this->matricule
        ]);
    }
}