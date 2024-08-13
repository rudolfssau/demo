<?php

namespace Main\App\Models\Domain\Entity\Attributes;

use Exception;

class Dimensions extends ProductAttribute
{
    /**
     * @param float $height
     * @param float $width
     * @param float $length
     * @throws Exception
     */
    public function __construct(protected float $height, protected float $width, protected float $length)
    {
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
    }

    /**
     * @param float $height
     * @return void
     * @throws Exception
     */
    public function setHeight(float $height): void
    {
        if (!isset($height) || !is_numeric($height)) {
            throw new Exception("Error setting Height attribute.");
        }
        $this->height = $height;
    }

    /**
     * @param float $length
     * @return void
     * @throws Exception
     */
    public function setLength(float $length): void
    {
        if (!isset($length) || !is_numeric($length)) {
            throw new Exception("Error setting Length attribute.");
        }
        $this->length = $length;
    }

    /**
     * @param float $width
     * @return void
     * @throws Exception
     */
    public function setWidth(float $width): void
    {
        if (!isset($width) || !is_numeric($width)) {
            throw new Exception("Error setting Width attribute.");
        }
        $this->width = $width;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'heightcm' => $this->height,
            'widthcm' => $this->width,
            'lengthcm' => $this->length
        ];
    }
}