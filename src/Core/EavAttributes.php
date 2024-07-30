<?php

namespace Main\Core;

class EavAttributes
{

    /**
     * @var string
     */
    private string $attributeName;

    /**
     * @var int
     */
    private int $attributeValue;

    /**
     * Defines array structure for product attributes.
     *
     * @param string $attributeName
     * @param int $attributeValue
     */
    public function __construct (string $attributeName, int $attributeValue)
    {
        $this->attributeName = $attributeName;
        $this->attributeValue = $attributeValue;
    }

    /**
     * @return string
     */
    public function getAttributeName(): string
    {
        return $this->attributeName;
    }

    /**
     * @return int
     */
    public function getAttributeValue(): int
    {
        return $this->attributeValue;
    }
}