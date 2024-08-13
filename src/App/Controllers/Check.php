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
        $request_body = file_get_contents('php://input');
        $sku = json_decode($request_body, true);
        $pdo = $this->connection->connect()->prepare('SELECT product_sku FROM products WHERE product_sku = :sku');
        $pdo->bindParam(':sku', $sku);
        $pdo->execute();

        return $pdo->fetchall(PDO::FETCH_ASSOC) ?: [];
    }
}
