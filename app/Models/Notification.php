<?php

namespace App\Models;

use App\Core\Model;

class Notification extends Model
{
    protected string $table = 'notifications';

    public int $id;
    public int $user_id;
    public string $message;
    public bool $is_read;
    public string $created_at;

    public function save(): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO notifications (user_id, message, is_read, created_at)
             VALUES (:user_id, :message, 0, NOW())"
        );

        return $stmt->execute([
            'user_id' => $this->user_id,
            'message' => $this->message
        ]);
    }
}
