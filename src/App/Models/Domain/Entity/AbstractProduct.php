<?php

declare(strict_types=1);

namespace Main\App\Models\Domain\Entity;

use Exception;
use Main\App\Models\Domain\Interface\ProductEntityInterface;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;
use ReflectionException;

abstract class AbstractProduct implements ProductEntityInterface
{
    /**
     * Object attributes
     *
     * @var array Contains all product values in a key => value format.
     */
    protected array $productValues = [];

    /**
     * Constructor
     *
     * Makes the main input fields always mandatory, also responsible for injecting dependency.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param string $sku
     * @param string $name
     * @param string $price
     * @param string $switcher
     * @param array $attributes
     * @param $attributeInstances
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        string $sku,
        string $name,
        string $price,
        string $switcher,
        array $attributes,
        protected $attributeInstances
    ) {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->setProductType($switcher);
        $this->setAttributes($attributes);
    }

    /**
     * Get SKU
     *
     * @return string|null
     */
    public function getSku(): mixed
    {
        return $this->productValues[self::SKU] ?? null;
    }

    /**
     * Set SKU
     *
     * @param string $sku
     * @return static
     * @throws Exception
     */
    public function setSku(string $sku): static
    {
        if ($this->productRepository->checkSKU($sku)) {
            throw new Exception("Error occurred in field SKU.");
        }
        $this->productValues[self::SKU] = $sku;
        return $this;
    }

    /**
     * Get name
     *
     * @return mixed
     */
    public function getName(): mixed
    {
        return $this->productValues[self::NAME] ?? null;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return static
     * @throws Exception
     */
    public function setName(string $name): static
    {
        if (is_numeric($name)) {
            throw new Exception("Name is not of type character.");
        }
        $this->productValues[self::NAME] = $name;
        return $this;
    }

    /**
     * Get price
     *
     * @return mixed
     */
    public function getPrice(): mixed
    {
        return $this->productValues[self::PRICE] ?? null;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return static
     * @throws Exception
     */
    public function setPrice(string $price): static
    {
        if (!is_numeric($price)) {
            throw new Exception("Price is not numeric type.");
        }
        $this->productValues[self::PRICE] = $price;
        return $this;
    }

    /**
     * Get product type
     *
     * @return mixed
     */
    public function getProductType(): mixed
    {
        return $this->productValues[self::PRODUCT_TYPE] ?? null;
    }

    /**
     * Set product type
     *
     * @param string $productType
     * @return static
     */
    public function setProductType(string $productType): static
    {
        $this->productValues[self::PRODUCT_TYPE] = $productType;
        return $this;
    }

    /**
     * Get attributes
     *
     * @return mixed
     */
    public function getAttributes(): mixed
    {
        return $this->productValues[self::ATTRIBUTES] ?? null;
    }

    /**
     * Set attributes
     *
     * @param array $attributes {"attributes" => [string attributeName => int attributeValue]}
     * @return static
     * @throws ReflectionException
     */

    public function setAttributes(array $attributes): static
    {
        foreach ($this->attributeInstances as $instanceName => $instanceClass)
        {
            $attributeClass = new $instanceClass;
            $attributeClass->setValue($attributes["attributes"][$instanceName]);
            $returnValues = $attributeClass->getValue();
            foreach ($returnValues as $key => $value) {
                $this->productValues[self::ATTRIBUTES][$key] = $value;
            }
        }
        return $this;
    }
}