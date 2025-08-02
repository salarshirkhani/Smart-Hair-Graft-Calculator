<?php
namespace App\Models;

use Core\Model;

class UserMeta extends Model {
    protected $table = 'usermeta';

    public function addMeta($userId, $key, $value, $type = 'data') {
        $userId = (int)$userId;
        $key = $this->escape($key);
        $value = $this->escape($value);

        $sql = "INSERT INTO {$this->table} (user_id, meta_key, meta_value)
                VALUES ($userId, '$key', '$value')";
        return $this->query($sql);
    }

    public function getAllMetaForUser($userId) {
        $userId = (int)$userId;
        $sql = "SELECT meta_key, meta_value FROM {$this->table} WHERE user_id = $userId";
        $result = $this->query($sql);

        $meta = [];
        while ($row = $result->fetch_assoc()) {
            $meta[$row['meta_key']] = $row['meta_value'];
        }
        return $meta;
    }

}
