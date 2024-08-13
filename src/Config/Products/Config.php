<?php

/**
 * Config file for Product and Attribute method allocation.
 * To add new either a new product/attribute, follow the pattern:
 *
 * @return array{
 *  product_type: array{
 *      class: string,
 *      attribute: string
 *  }
 * }
 *
 */
return [
    "dvd" => [
        "class" => Main\App\Models\Domain\Entity\Dvd::class,
        "attribute" => Main\App\Models\Domain\Entity\Attributes\Size::class
    ],
    "book" => [
        "class" => Main\App\Models\Domain\Entity\Book::class,
        "attribute" => Main\App\Models\Domain\Entity\Attributes\Weight::class
    ],
    "furniture" => [
        "class" => Main\App\Models\Domain\Entity\Furniture::class,
        "attribute" => Main\App\Models\Domain\Entity\Attributes\Dimensions::class
    ]
];