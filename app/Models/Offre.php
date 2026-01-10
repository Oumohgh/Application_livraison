<?php
/**
 * Offre Model
 * 
 * Represents offers made by livreurs for commandes.
 * A livreur creates an offer for a commande with a price and delivery time.
 * The client can then accept one of the offers.
 */

namespace App\Models;

use App\Core\Model;
use PDO;

class Offre extends Model
{
    protected string $table = 'offres';

    // Public properties
    public int $id;
    public int $commande_id;
    public int $livreur_id;
    public float $prix;
    public int $duree; // Duration in minutes
    public string $created_at;
    public ?string $livreur_name = null; // Used when joining with users table

    /**
     * Save a new offer to the database
     * 
     * @return bool True if successful
     */
    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (commande_id, livreur_id, prix, duree, created_at) 
             VALUES (:commande_id, :livreur_id, :prix, :duree, NOW())"
        );

        return $stmt->execute([
            'commande_id' => $this->commande_id,
            'livreur_id' => $this->livreur_id,
            'prix' => $this->prix,
            'duree' => $this->duree
        ]);
    }

    /**
     * Find all offers for specific commande
     * Includes livreur name via JOIN for display in views
     * 
     * @param int $commandeId Commande ID to filter by
     * @return array Array of Offre objects with livreur_name property
     */
    public function findByCommande(int $commandeId): array
    {
        $stmt = $this->db->prepare(
            "SELECT o.*, u.name as livreur_name 
             FROM {$this->table} o 
             JOIN users u ON o.livreur_id = u.id 
             WHERE o.commande_id = :commande_id 
             ORDER BY o.prix ASC"
        );
        $stmt->execute(['commande_id' => $commandeId]);
        
        // Use FETCH_ASSOC and manually map to handle JOIN fields
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $offre = new self();
            $offre->id = $row['id'];
            $offre->commande_id = $row['commande_id'];
            $offre->livreur_id = $row['livreur_id'];
            $offre->prix = $row['prix'];
            $offre->duree = $row['duree'];
            $offre->created_at = $row['created_at'];
            $offre->livreur_name = $row['livreur_name']; // Extra property from JOIN
            $results[] = $offre;
        }
        return $results;
    }

    /**
     * Find all offers made by specific livreur
     * 
     * @param int $livreurId Livreur ID to filter by
     * @return array Array of Offre objects
     */
    public function findByLivreur(int $livreurId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} 
             WHERE livreur_id = :livreur_id 
             ORDER BY created_at DESC"
        );
        $stmt->execute(['livreur_id' => $livreurId]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    /**
     * Check if livreur already made offer for commande
     * Prevents duplicate offers from same livreur
     * 
     * @param int $commandeId Commande ID to check
     * @param int $livreurId Livreur ID to check
     * @return bool True if offer already exists
     */
    public function exists(int $commandeId, int $livreurId): bool
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM {$this->table} 
             WHERE commande_id = :commande_id AND livreur_id = :livreur_id"
        );
        $stmt->execute([
            'commande_id' => $commandeId,
            'livreur_id' => $livreurId
        ]);
        
        return $stmt->fetchColumn() > 0;
    }
}