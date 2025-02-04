<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $db = null;
    private static string $host = 'localhost';
    private static string $dbname = 'project_mvc';
    private static string $user = 'postgres';
    private static string $pass = 'root';

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if (self::$db === null) {
            try {
                $dsn = "pgsql:host=" . self::$host . ";dbname=" . self::$dbname . ";port=5432";
                self::$db = new PDO($dsn, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);

                self::initializeDatabase();
            } catch (PDOException $e) {
                error_log("Database Connection Error: " . $e->getMessage());
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$db;
    }

    private static function initializeDatabase()
    {
        try {
            $dbExists = self::$db->query("SELECT 1 FROM pg_database WHERE datname = '" . self::$dbname . "'")->fetch();

            if (!$dbExists) {
                self::$db->exec("CREATE DATABASE " . self::$dbname);
                $sql = file_get_contents('database/database.sql');
                self::$db->exec($sql);
            }
        } catch (PDOException $e) {
            error_log("Database Initialization Error: " . $e->getMessage());
            die("Database initialization failed: " . $e->getMessage());
        }
    }
}

