<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CommandeItem extends Model
{
    protected string $table = 'commande_items';

    public int $id;
    public int $commande_id;
    public string $description;
    public int $quantity;

    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO commande_items (commande_id, description, quantity)
             VALUES (:commande_id, :description, :quantity)"
        );

        return $stmt->execute([
            'commande_id' => $this->commande_id,
            'description' => $this->description,
            'quantity'    => $this->quantity
        ]);
    }

    public function findByCommande(int $commandeId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM commande_items WHERE commande_id = :id"
        );
        $stmt->execute(['id' => $commandeId]);

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
        return $stmt->fetchAll();
    }
}
