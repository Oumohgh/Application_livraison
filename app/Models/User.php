<?php
/**
 * User Model
 * 
 * Represents users in the database.
 * Handles all database operations related to users (CRUD).
 * 
 * Why public properties?
 * - Simple and beginner-friendly
 * - Easy to access: $user->name, $user->email
 * - Works well with PDO::FETCH_CLASS
 */

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model
{
    protected string $table = 'users';

    // Public properties (automatically filled by PDO::FETCH_CLASS)
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $role; // 'client', 'livreur', or 'admin'

    /**
     * Save a new user to the database
     * 
     * @return bool True if successful
     */
    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name, email, password, role) 
             VALUES (:name, :email, :password, :role)"
        );

        return $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'role' => $this->role
        ]);
    }

    /**
     * Find user by email address
     * Used during login to locate user account
     * 
     * @param string $email Email address to search for
     * @return self|null User object if found, null otherwise
     */
    public function findByEmail(string $email): ?self
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Find all users with specific role
     * 
     * @param string $role Role to filter by ('client', 'livreur', or 'admin')
     * @return array Array of User objects
     */
    public function findByRole(string $role): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE role = :role");
        $stmt->execute(['role' => $role]);
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    /**
     * Verify password
     * 
     * @param string $password The plain password to verify
     * @return bool True if password matches
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}