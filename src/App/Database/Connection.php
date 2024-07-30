<?php

namespace Main\App\Database;

use PDO;
use Main\Config\Database\Config;

class Connection
{
    /**
     * Database connection.
     *
     * @return PDO
     * @throws \PDOException
     */
    public function connect(): PDO
    {
        return new \PDO('mysql:host='.Config::DB_HOST.';port=3306;dbname='.Config::DB_NAME.';charset=utf8mb4', Config::DB_USERNAME, Config::DB_PASSWORD, Config::OPTIONS);
    }
}