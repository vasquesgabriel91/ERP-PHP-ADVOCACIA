<?php
namespace database;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $pdo = new PDO(
                "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'),
                $pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS')),
                $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION),
                $pdo-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ),
            );
        }catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->connection;
    }
    public function query($sql, $params = []) {
        $smtm = $this->connection->prepare($sql);
        $smtm->execute($params);
        return $smtm;
    }
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
}