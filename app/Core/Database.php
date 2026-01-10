<?php
/**
 * Database Class - Singleton Pattern
 * 
 * Manages database connection using Singleton pattern.
 * Ensures only ONE PDO connection exists throughout the application.
 * 
 * Why Singleton?
 * - Prevents multiple database connections (saves resources)
 * - Provides single point of access to database
 * - Reuses same connection across all models
 */

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private ?PDO $connection = null;

    /**
     * Private constructor prevents direct instantiation
     * Use getInstance() instead
     */
    private function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        
        try {
            $this->connection = new PDO(
                $config['dsn'],
                $config['user'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Get the single instance of Database
     * If no instance exists, create one
     * If instance exists, return the existing one
     */
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the PDO connection
     * Models will use this to execute SQL queries
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}

    /**
     * Prevent unserialization of the instance
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}