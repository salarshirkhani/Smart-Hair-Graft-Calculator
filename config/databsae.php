<?php
namespace Config;

use mysqli;

class Database {
    protected static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            self::$connection = new mysqli(
                getenv('DB_HOST'),
                getenv('DB_USER'),
                getenv('DB_PASS'),
                getenv('DB_NAME')
            );

            if (self::$connection->connect_error) {
                die('Database connection failed: ' . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
