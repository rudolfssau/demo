<?php

namespace Main\App\Models\Persistence;

use Exception;
use Main\App\Database\Connection;
use Main\App\Models\Domain\Repository\AttributeRepositoryInterface;
use Main\Core\EavAttributes;
use PDO;

class AttributeMySQLRepository implements AttributeRepositoryInterface
{
    /**
     * @param Connection $connection
     */
    public function __construct(private readonly Connection $connection)
    {
    }

    /**
     * Product specific attribute insertion.
     *
     * @param int $productId
     * @param EavAttributes|array $attributes
     * @return void
     * @throws Exception
     */
    public function save(int $productId, array|EavAttributes $attributes): void
    {
        $pdo = $this->connection->connect();

        foreach ($attributes as $attribute)
        {
            $attributeName = $attribute->getAttributeName();
            $attributeValue = $attribute->getAttributeValue();
            $statement = $pdo->prepare("SELECT attribute_id FROM attributes WHERE attribute_name = :name");
            $statement->bindParam(':name', $attributeName);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                throw new Exception("Attribute cannot be found in database");
            }

            $statement = $pdo->prepare("
                INSERT INTO attributes_values (
                    product_id,
                    attribute_id,
                    attribute_value
                ) VALUES (
                    :product_id,
                    :attribute_id,
                    :value
                )
            ");
            $statement->bindParam(':product_id', $productId);
            $statement->bindParam(':attribute_id', $row['attribute_id']);
            $statement->bindParam(':value', $attributeValue);
            $statement->execute();
        }
    }

    /**
     * delete is responsible for deleting product-specific attributes from the database.
     *
     * @param int $productId
     * @return void
     */
    public function delete(int $productId): void
    {
        $pdo = $this->connection->connect();

        $statement = $pdo->prepare("DELETE FROM attributes_values WHERE product_id = :product_id");
        $statement->bindParam(':product_id', $productId);
        $statement->execute();
    }
}