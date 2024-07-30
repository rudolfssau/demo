<?php

namespace Main\App\Models\Domain\Entity;

use Exception;
use Main\App\Models\Domain\Interface\Product;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;

class Furniture extends AbstractProduct implements Product
{
    /**
     * @param ProductRepositoryInterface $productRepository
     * @param string $sku
     * @param string $name
     * @param string $price
     * @param string $switcher
     * @param array $attributes {string "attributeName" => int attributeValue}
     * @param $attributeInstances
     * @throws Exception
     */
    public function __construct (
        ProductRepositoryInterface $productRepository,
        string $sku,
        string $name,
        string $price,
        string $switcher,
        array $attributes,
        protected $attributeInstances
    ) {
        parent::__construct($productRepository, $sku, $name, $price, $switcher, $attributes, $attributeInstances);
    }
}