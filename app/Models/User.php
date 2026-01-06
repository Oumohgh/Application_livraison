<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model
{
    protected string $table = 'users';

    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public int $role_id;

    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role_id)
             VALUES (:name, :email, :password, :role_id)"
        );

        return $stmt->execute([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'role_id'  => $this->role_id
        ]);
    }

    public function findByEmail(string $email): ?self
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
        return $stmt->fetch() ?: null;
    }
}