<?php
namespace App\Models;

use Core\Model;

class Diagnosis extends Model {
    protected $table = 'diagnosis';

    public function create($data) {
        $userId = (int)$data['user_id'];
        $method = $this->escape($data['method']);
        $graftcount = (int)$data['graft_count'];
        $branch = $this->escape($data['branch']);
        $aiResult = $this->escape($data['ai_result']);

        $sql = "INSERT INTO {$this->table} (user_id, method, graft_count, branch, ai_result)
                VALUES ($userId, '$method', $graftcount, '$branch', '$aiResult')";
        return $this->query($sql);
    }

    public function findByUser($userId) {
        $userId = (int)$userId;
        $sql = "SELECT * FROM {$this->table} WHERE user_id = $userId ORDER BY created_at DESC LIMIT 1";
        return $this->query($sql)->fetch_assoc();
    }
}
