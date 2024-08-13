<?php

namespace Main\App\Models\Domain\Entity\Attributes;

abstract class ProductAttribute
{
    /**
     * Attribute allocation.
     *
     * @return array
     */
    public abstract function attributes(): array;
}