<?php

namespace Main\App\Models\Persistence;

use Main\App\Database\Connection;
use Main\App\Models\Domain\Entity\Product;
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
     * @param Product $product
     * @return string|false
     */
    public function save(Product $product): string|false
    {
        $pdo = $this->connection->connect();

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
                :productType
            )
        ");
        $statement->execute([
            ':sku' => $product->sku,
            ':name' => $product->name,
            ':price' => $product->price,
            ':productType' => $product->productType,
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