<?php

/**
 * Config file for Product and Attribute method allocation.
 * To add new either a new product/attribute, follow the pattern:
 *
 * attributeName has to be based on the attribute value fetched from the frontend.
 *
 * @return array{
 *  switcher: array{
 *      class: string,
 *      attributes: array{
 *          attributeName: string
 *      }
 *  }
 * }
 *
 */
return [
    "dvd" => [
        "class" => "Main\App\Models\Domain\Entity\Dvd",
        "attributes" => [
            "sizemb" => "Main\App\Models\Domain\Entity\Attributes\SizeMB"
        ]
    ],
    "book" => [
        "class" => "Main\App\Models\Domain\Entity\Book",
        "attributes" => [
            "weightkg" => "Main\App\Models\Domain\Entity\Attributes\Weight"
        ]
    ],
    "furniture" => [
        "class" => "Main\App\Models\Domain\Entity\Furniture",
        "attributes" => [
            "heightcm" => "Main\App\Models\Domain\Entity\Attributes\Height",
            "widthcm" => "Main\App\Models\Domain\Entity\Attributes\Width",
            "lengthcm" => "Main\App\Models\Domain\Entity\Attributes\Length"
        ]
    ]
];