<?php
/**
 * Commande Model
 * 
 * Represents commandes (delivery orders) in the database.
 * Handles all database operations related to commandes.
 * 
 * Commande Lifecycle:
 * 1. "en_attente" - Created by client, waiting for offers
 * 2. "acceptee" - Client accepted an offer
 * 3. "livree" - Livreur marked as delivered
 * 4. "terminee" - Order completed
 */

namespace App\Models;

use App\Core\Model;
use PDO;

class Commande extends Model
{
    protected string $table = 'commandes';

    // Status constants
    public const STATUS_EN_ATTENTE = 'en_attente';
    public const STATUS_ACCEPTEE = 'acceptee';
    public const STATUS_LIVREE = 'livree';
    public const STATUS_TERMINEE = 'terminee';

    // Public properties
    public int $id;
    public int $client_id;
    public ?int $livreur_id; // null until an offer is accepted
    public string $description;
    public string $adresse_livraison;
    public string $statut;
    public float $prix_final; // Price from the accepted offer
    public string $created_at;
    public ?string $updated_at;

    /**
     * Save a new commande to the database
     * 
     * @return bool True if successful
     */
    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (client_id, description, adresse_livraison, statut, created_at) 
             VALUES (:client_id, :description, :adresse_livraison, :statut, NOW())"
        );

        return $stmt->execute([
            'client_id' => $this->client_id,
            'description' => $this->description,
            'adresse_livraison' => $this->adresse_livraison,
            'statut' => $this->statut
        ]);
    }

    /**
     * Update commande status
     * 
     * @param string $statut New status value
     * @return bool True if update successful
     */
    public function updateStatus(string $statut): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET statut = :statut, updated_at = NOW() WHERE id = :id"
        );

        return $stmt->execute([
            'statut' => $statut,
            'id' => $this->id
        ]);
    }

    /**
     * Accept offer and update commande
     * Sets livreur_id, prix_final, and changes status to "acceptee"
     * 
     * @param int $livreurId Livreur ID from accepted offer
     * @param float $prixFinal Price from accepted offer
     * @return bool True if update successful
     */
    public function acceptOffer(int $livreurId, float $prixFinal): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} 
             SET livreur_id = :livreur_id, prix_final = :prix_final, statut = :statut, updated_at = NOW() 
             WHERE id = :id"
        );

        return $stmt->execute([
            'livreur_id' => $livreurId,
            'prix_final' => $prixFinal,
            'statut' => self::STATUS_ACCEPTEE,
            'id' => $this->id
        ]);
    }

    /**
     * Find all commandes for specific client
     * 
     * @param int $clientId Client ID to filter by
     * @return array Array of Commande objects
     */
    public function findByClient(int $clientId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE client_id = :client_id ORDER BY created_at DESC"
        );
        $stmt->execute(['client_id' => $clientId]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    /**
     * Find all available commandes (status "en_attente")
     * Available for livreurs to make offers
     * 
     * @return array Array of Commande objects
     */
    public function findAvailable(): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE statut = :statut ORDER BY created_at DESC"
        );
        $stmt->execute(['statut' => self::STATUS_EN_ATTENTE]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    /**
     * Find all commandes assigned to specific livreur
     * 
     * @param int $livreurId Livreur ID to filter by
     * @return array Array of Commande objects
     */
    public function findByLivreur(int $livreurId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE livreur_id = :livreur_id ORDER BY created_at DESC"
        );
        $stmt->execute(['livreur_id' => $livreurId]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }
}