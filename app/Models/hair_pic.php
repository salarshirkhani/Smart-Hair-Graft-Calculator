<?php
namespace App\Models;

use Core\Model;

class hair_pic extends Model {
    
    protected $table = 'hair_pics';

    public function insertPic($userId, $filePath, $position) {
        $userId = (int)$userId;
        $filePath = $this->escape($filePath);
        $position = $this->escape($position);

        $sql = "INSERT INTO {$this->table} (user_id, file, position)
                VALUES ($userId, '$filePath', '$position')";
        return $this->query($sql);
    }

    public function getPicsByUser($userId) {
        $userId = (int)$userId;
        $sql = "SELECT file, position FROM {$this->table} WHERE user_id = $userId";
        $result = $this->query($sql);

        $pics = [];
        while ($row = $result->fetch_assoc()) {
            $pics[] = $row;
        }
        return $pics;
    }
}
