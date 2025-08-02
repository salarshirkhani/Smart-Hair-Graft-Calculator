<?php
namespace App\Models;

use Core\Model;

class User extends Model {
    
    protected $table = 'users';

    public function create($data) {
        $firstName = $this->escape($data['first_name']);
        $lastName = $this->escape($data['last_name']);
        $gender = $this->escape($data['gender']);
        $age = (int)$data['age'];
        $mobile = $this->escape($data['mobile']);

        $sql = "INSERT INTO {$this->table} (first_name, last_name, gender, age, mobile)
                VALUES ('$firstName', '$lastName', '$gender', $age, '$mobile')";

        if ($this->query($sql)) {
            return $this->conn->insert_id; // برگردوندن ID کاربر جدید
        }
        return false;
    }

    public function findById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM {$this->table} WHERE id = $id";
        return $this->query($sql)->fetch_assoc();
    }
}
