<?php
namespace Core;


class Model {
    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // QUERY
    protected function query($sql) {
        return $this->conn->query($sql);
    }

    // Prevent SQL Injection
    protected function escape($value) {
        return $this->conn->real_escape_string($value);
    }
}
