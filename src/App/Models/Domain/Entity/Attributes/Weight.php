<?php

namespace Main\App\Models\Domain\Entity\Attributes;

use Exception;

class Weight extends ProductAttribute
{
    /**
     * @param float $kilograms
     * @throws Exception
     */
    public function __construct(protected float $kilograms)
    {
        $this->setMegabytes($this->kilograms);
    }

    /**
     * @param float $kilograms
     * @return void
     * @throws Exception
     */
    public function setMegabytes(float $kilograms): void
    {
        if (!isset($kilograms) || !is_numeric($kilograms)) {
            throw new Exception("Error setting Size MB attribute.");
        }
        $this->kilograms = $kilograms;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'weightkg' => $this->kilograms
        ];
    }
}