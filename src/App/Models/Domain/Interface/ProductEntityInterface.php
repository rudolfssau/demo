<?php

declare(strict_types = 1);

namespace Main\App\Models\Domain\Interface;

/**
 * Product defines the base interface all "Product" member classes have to adhere to.
 */
interface ProductEntityInterface
{
    /**
     * String constants for property names.
     */
    const SKU = "sku";
    const NAME = "name";
    const PRICE = "price";
    const PRODUCT_TYPE = "product_type";
    const ATTRIBUTES = "attributes";

    /**
     * Getter for SKU.
     *
     * @return array|null
     */
    public function getSku(): mixed;

    /**
     * Setter for SKU.
     *
     * @param string $sku
     * @return static
     */
    public function setSku(string $sku): static;

    /**
     * Getter for Name.
     *
     * @return mixed
     */
    public function getName(): mixed;

    /**
     * Setter for Name.
     *
     * @param string $name
     * @return static
     */
    public function setName(string $name): static;

    /**
     * Getter for Price.
     *
     * @return array|null
     */
    public function getPrice(): mixed;

    /**
     * Setter for Price.
     *
     * @param string $price
     * @return static
     */
    public function setPrice(string $price): static;

    /**
     * Getter for Product Type.
     *
     * @return array|null
     */
    public function getProductType(): mixed;

    /**
     * Setter for Product Type.
     *
     * @param string $productType
     * @return static
     */
    public function setProductType(string $productType): static;

    /**
     * Getter for Attributes.
     *
     * @return mixed
     */
    public function getAttributes(): mixed;

    /**
     * Setter for Attributes.
     *
     * @return $this
     */
    public function setAttributes(array $attributes): static;
}