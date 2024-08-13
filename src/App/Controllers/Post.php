<?php

namespace Main\App\Controllers;

use Exception;
use Main\App\Database\Connection;
use Main\App\Models\Domain\Entity\ProductFactory;
use Main\App\Models\Domain\Interface\ProductEntityInterface;
use Main\App\Models\Domain\Repository\AttributeRepositoryInterface;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;
use Main\Core\EavAttributes;

class Post extends Controller
{
    /**
     * @param ProductRepositoryInterface $productRepository
     * @param AttributeRepositoryInterface $attributeRepository
     * @param Connection $connection
     * @param ProductFactory $productFactory
     */
    public function __construct (
        protected ProductRepositoryInterface $productRepository,
        protected AttributeRepositoryInterface $attributeRepository,
        protected readonly Connection $connection,
        protected ProductFactory $productFactory
    )
    {
    }

    /**
     * Insert object data into database.
     * Product and Attribute insertion gets handled separately.
     *
     * @return void
     * @throws Exception
     */
    public function __invoke(): void
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $product = $this->productFactory->build(
            $data[ProductEntityInterface::SKU],
            $data[ProductEntityInterface::NAME],
            $data[ProductEntityInterface::PRICE],
            $data[ProductEntityInterface::PRODUCT_TYPE],
            $data[ProductEntityInterface::ATTRIBUTES],
            $this->productRepository
        );

        /**
         * Save product
         */
        $productInsert = $this->productRepository->save($product);

        /**
         * Save product attributes
         */
        foreach ($product->attributes as $attributeName => $attributeValue)
        {
            $this->attributeRepository->save($productInsert, [new EavAttributes($attributeName, $attributeValue)]);
        }
    }
}