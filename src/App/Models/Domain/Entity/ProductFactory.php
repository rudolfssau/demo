<?php

namespace Main\App\Models\Domain\Entity;

use Main\App\Models\Domain\Repository\ProductRepositoryInterface;
use Main\Core\Container;

class ProductFactory
{
    /**
     * Stores attributes that get injected into each product.
     *
     * @var array
     */
    protected array $attributes = [];

    /**
     * @param Container $container
     */
    public function __construct (protected Container $container)
    {
    }

    /**
     * Builds the corresponding product class based on the provided switcher parameter.
     * Based on the provided attributes inside the Config.php file, this function also passes all necessary attribute instances to the specific product.
     *
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $product_type
     * @param array $attributeValue
     * @param ProductRepositoryInterface $productRepository
     * @return Product
     */
    public function build(string $sku, string $name, float $price, string $product_type, array $attributeValue, ProductRepositoryInterface $productRepository): Product
    {
        $configFile = require __DIR__ . '/../../../../Config/Products/Config.php';
        $productConfig = $configFile[$product_type];
        $productClass = $productConfig['class'];
        foreach ($attributeValue['attributes'] as $attributeName => $attributeValue)
        {
            array_push($this->attributes, $attributeValue);
        }

        return new $productClass($sku, $name, $price, $product_type, new $productConfig['attribute'](...$this->attributes), $productRepository);
    }
}