<?php
namespace FirstTask\Core;

require_once 'app/config/database.php';

final class Database 
{
    private static $connection = null;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function connect()
    {
        if (self::$connection) {
            return self::$connection;
        }

        $dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "";
        self::$connection = new \PDO($dns, DB_USER, DB_PASSWORD);

        // $data = self::$connection->query('SELECT * FROM categories')->fetchAll();
        // die(count($data));

        return self::$connection;
    }
}