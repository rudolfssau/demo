<?php

namespace Main\App\Controllers;

use Main\App\Database\Connection;
use PDO;

class Get extends Controller
{
    /**
     * @param Connection $connection
     */
    public function __construct (protected readonly Connection $connection)
    {
    }

    /**
     * Creates a new object and passes it into a json format over to Ajax.
     *
     * @return array
     */
    public function __invoke(): array
    {
        header('Content-Type: application/json');
        $pdo = $this->connection->connect()->prepare(
            'SELECT
            p.product_id,
            p.product_sku,
            p.product_name,
            p.product_price,
            p.product_type,
            JSON_OBJECTAGG(a.attribute_name, av.attribute_value) AS attributes
        FROM
            products AS p
        LEFT JOIN
            attributes_values AS av
        ON
            p.product_id = av.product_id
        LEFT JOIN
            attributes AS a
        ON
            av.attribute_id = a.attribute_id
        GROUP BY
            av.product_id'
        );
        $pdo->execute();

        return $pdo->fetchall(PDO::FETCH_ASSOC) ?: [];
    }
}
