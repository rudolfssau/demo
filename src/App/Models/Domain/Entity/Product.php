<?php

namespace Main\App\Models\Domain\Entity;

use Main\App\Models\Domain\Entity\Attributes\ProductAttribute;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;

abstract class Product
{
    /**
     * Base class constructor template.
     *
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $productType
     * @param ProductAttribute $productAttribute
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(string $sku, string $name, float $price, string $productType, ProductAttribute $productAttribute, ProductRepositoryInterface $productRepository)
    {
    }
}