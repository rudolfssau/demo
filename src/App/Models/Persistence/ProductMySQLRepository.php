<?php

namespace Main\App\Models\Persistence;

use Main\App\Database\Connection;
use Main\App\Models\Domain\Entity\AbstractProduct;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;
use PDO;

class ProductMySQLRepository implements ProductRepositoryInterface
{
    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection)
    {
    }

    /**
     * Main product data insertion.
     *
     * @param AbstractProduct $product
     * @return string|false
     */
    public function save(AbstractProduct $product): string|false
    {
        $pdo = $this->connection->connect();

        print_r($product->getAttributes());

        $statement = $pdo->prepare("
        INSERT INTO products (
                product_sku,
                product_name,
                product_price,
                product_type
            ) VALUES (
                :sku,
                :name,
                :price,
                :product_type
            )
        ");
        $statement->execute([
            ':sku' => $product->getSku(),
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':product_type' => $product->getProductType(),
        ]);

        return $pdo->lastInsertId();
    }

    /**
     * delete function is responsible for deleting selected products from database.
     *
     * @param int $productId
     * @return void
     */
    public function delete(int $productId): void
    {
        $pdo = $this->connection->connect();
        $statement = $pdo->prepare("DELETE FROM products WHERE product_id = :id");
        $statement->bindParam(':id', $productId);
        $statement->execute();
    }

    /**
     * checkSKU function is responsible for checking if given SKU value (passed into parameter as string $sku) already exists in the database.
     *
     * @param string $sku
     * @return mixed
     */
    public function checkSKU(string $sku): mixed
    {
        $pdo = $this->connection->connect();
        $statement = $pdo->prepare("SELECT COUNT(*) as count FROM products WHERE product_sku = :sku");
        $statement->bindParam(':sku', $sku);
        $statement->execute();
        $values = $statement->fetch(PDO::FETCH_ASSOC);
        return $values['count'];
    }
}