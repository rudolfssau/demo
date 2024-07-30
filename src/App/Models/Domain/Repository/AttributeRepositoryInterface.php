<?php

namespace Main\App\Models\Domain\Repository;

use Main\Core\EavAttributes;

interface AttributeRepositoryInterface
{
    /**
     * Saves the product-specific values to the attribute database. For $attributes format, check EavAttributes.
     *
     * @param int $productId is used to define the ID of the entity (Product) last inserted into the database.
     * @param array|EavAttributes $attributes defines the attributes as an array, [key => value].
     * @return void
     */
    public function save(int $productId, array|EavAttributes $attributes): void;

    /**
     * Delete method definition.
     *
     * @param int $productId
     * @return void
     */
    public function delete(int $productId): void;
}