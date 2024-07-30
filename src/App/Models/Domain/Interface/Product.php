<?php

namespace Main\App\Models\Domain\Interface;

use Main\App\Models\Domain\Repository\ProductRepositoryInterface;

interface Product
{
    /**
     * Used to define constructor for each product. Values can be made Product-specific in each constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param string $sku
     * @param string $name
     * @param string $price
     * @param string $switcher
     * @param array $attributes
     * @param $attributeInstances
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        string $sku,
        string $name,
        string $price,
        string $switcher,
        array $attributes,
        $attributeInstances
    );
}