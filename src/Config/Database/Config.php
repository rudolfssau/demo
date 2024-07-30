<?php

namespace Main\Config\Database;

class Config
{
    /**
     * Database config definition.
     */
    const DB_HOST = 'mysql-service';
    const DB_NAME = 'main';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'root';
    const OPTIONS = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];
}