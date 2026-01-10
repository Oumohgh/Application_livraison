<?php
/**
 * Base Model Class
 * 
 * Parent class for all models (User, Commande, Offre).
 * Provides common database functionality shared by all models.
 * 
 * Why Base Model?
 * - Avoids code duplication (DRY principle)
 * - All models share same database connection
 * - Provides common CRUD methods
 */

namespace App\Core;

use PDO;

abstract class Model
{
    protected PDO $db;
    protected string $table;

    /**
     * Constructor - Initializes database connection
     * Each child class must define $table property
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Find record by ID
     * 
     * @param int $id ID to search for
     * @return object|null Found record or null if not found
     */
    public function find(int $id): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        // PDO::FETCH_CLASS creates object of calling class
        // Example: $user = $userModel->find(1); echo $user->name;
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetch() ?: null;
    }

    /**
     * Find all records from table
     * 
     * @return array Array of model objects
     */
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    /**
     * Delete record by ID
     * 
     * @param int $id ID to delete
     * @return bool True if deletion successful
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}