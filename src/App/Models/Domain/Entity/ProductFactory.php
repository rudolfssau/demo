<?php

namespace Main\App\Models\Domain\Entity;

use Exception;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;
use Main\Core\Container;
use Main\Core\Exceptions\ContainerException;

class ProductFactory
{
    public function __construct (protected Container $container)
    {
    }

    /**
     * Builds the corresponding product class based on the provided switcher parameter.
     * Based on the provided attributes inside the Config.php file, this function also passes all necessary attribute instances to the specific product.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param $sku
     * @param $name
     * @param $price
     * @param $switcher
     * @param $attributes
     * @return AbstractProduct
     * @throws Exception
     */
    public function build(ProductRepositoryInterface $productRepository, $sku, $name, $price, $switcher, $attributes): AbstractProduct
    {
        $configFile = require __DIR__ . '/../../../../Config/Products/Config.php';
        $productConfig = $configFile[$switcher];
        $productClass = $productConfig['class'];
        $attributeInstances = [];
        foreach ($productConfig['attributes'] as $attributeName => $attributeClass) {
            try {
                $attributeInstances[$attributeName] = $this->container->get($attributeClass);
            } catch (ContainerException $e) {
                throw new Exception($e);
            }
        }
        return new $productClass($productRepository, $sku, $name, $price, $switcher, $attributes, $attributeInstances);
    }
}