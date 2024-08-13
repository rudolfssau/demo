<?php

namespace Main\App\Models\Domain\Repository;

use Main\App\Models\Domain\Entity\AbstractProduct;
use Main\App\Models\Domain\Entity\Product;
use Main\App\Models\Domain\Entity\ProductFactory;

/**
 * Provides the base format to create new repo file.
 */
interface ProductRepositoryInterface
{
    /**
     * Save method definition.
     *
     * @param Product $product
     * @return string|false
     */
    public function save(Product $product): string|false;

    /**
     * Delete method definition.
     *
     * @param int $productId
     * @return void
     */
    public function delete(int $productId): void;

    /**
     * checkSKU method definition for checking SKU in database.
     *
     * @param string $sku
     * @return mixed
     */
    public function checkSKU(string $sku): mixed;
}