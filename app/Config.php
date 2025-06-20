<?php
namespace App;
use PDO;

class Config{
    private PDO $pdo;
    public function __construct()
    {
    $defaultOptions = [
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

    try {
    $this->pdo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_OPTIONS'] ?? $defaultOptions
    );
    } catch (\PDOException $e) {
    echo "Database error: " . $e->getMessage();
    }
    }
    public function __call($name, $arguments)
    {
      return call_user_func_array([$this->pdo,$name],$arguments);
    }
}