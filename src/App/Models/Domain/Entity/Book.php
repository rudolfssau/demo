<?php

namespace Main\App\Models\Domain\Entity;

use Exception;
use Main\App\Models\Domain\Entity\Attributes\ProductAttribute;
use Main\App\Models\Domain\Entity\Attributes\Weight;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;

class Book extends Product
{
    /**
     * Stores attribute values.
     *
     * @var array
     */
    protected array $attributes;

    /**
     * Stores product name value.
     *
     * @var string
     */
    protected string $name;

    /**
     * Stores product price value.
     *
     * @var float
     */
    protected float $price;

    /**
     * Stores the product sku value.
     *
     * @var string
     */
    protected string $sku;

    /**
     * Stores the product type.
     *
     * @var string
     */
    protected string $productType;

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $productType
     * @param ProductAttribute $productAttribute
     * @param ProductRepositoryInterface $productRepository
     * @throws Exception
     */
    public function __construct(
        string $sku,
        string $name,
        float $price,
        string $productType,
        protected ProductAttribute $productAttribute,
        protected ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($sku, $name, $price, $productType, $productAttribute, $this->productRepository);
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->productType = $productType;
        $this->setAttributes($productAttribute);
    }

    /**
     * @param string $sku
     * @throws Exception
     */
    public function setSku(string $sku): void
    {
        if ($this->productRepository->checkSKU($sku)) {
            throw new Exception("Error occurred in field SKU.");
        }
        $this->sku = $sku;
    }

    /**
     * @param string $name
     * @throws Exception
     */
    public function setName(string $name): void
    {
        if (is_numeric($name)) {
            throw new Exception("Name is not of type character.");
        }
        $this->name = $name;
    }

    /**
     * @param float $price
     * @throws Exception
     */
    public function setPrice(float $price): void
    {
        if (!is_numeric($price)) {
            throw new Exception("Price is not numeric type.");
        }
        $this->price = $price;
    }

    /**
     * @param Weight $weight
     * @return void
     */
    private function setAttributes(Weight $weight): void
    {
        $this->attributes = $weight->attributes();
    }

    /**
     * @param $property
     * @return mixed
     * @throws Exception
     */
    public function __get($property): mixed
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("Cannot find property - " . $this->$property);
        }
    }
}