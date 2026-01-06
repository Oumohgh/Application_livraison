<?php

namespace App\Models;

use App\Core\Model;

class Commande extends Model
{
    protected string $table = 'commandes';

    public int $id;
    public int $client_id;
    public string $statut;
    public string $created_at;

    public const PENDING   = 'pending';
    public const ACCEPTED  = 'accepted';
    public const DELIVERED = 'delivered';

    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO commandes (client_id, statut, created_at)
             VALUES (:client_id, :statut, NOW())"
        );

        return $stmt->execute([
            'client_id' => $this->client_id,
            'statut'    => self::PENDING
        ]);
    }

    public function changeStatus(string $status): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE commandes SET statut = :statut WHERE id = :id"
        );

        return $stmt->execute([
            'statut' => $status,
            'id'     => $this->id
        ]);
    }
}
