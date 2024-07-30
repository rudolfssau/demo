<?php

namespace Main\App\Controllers;

use Main\App\Database\Connection;
use PDO;

class Check extends Controller
{
    /**
     * @param Connection $connection
     */
    public function __construct (protected readonly Connection $connection)
    {
    }

    /**
     * Responsible for getting the "sku" values from the MySQL database
     * and encoding them in a json file, which later on gets
     * processed by Axios in Vue.js
     *
     * @return array
     */
    public function __invoke(): array
    {
        header('Content-Type: application/json');
        $pdo = $this->connection->connect()->prepare('SELECT product_sku FROM products');
        $pdo->execute();

        return $pdo->fetchall(PDO::FETCH_ASSOC) ?: [];
    }
}
