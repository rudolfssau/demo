<?php

namespace Main\App\Models\Domain\Entity\Attributes;

use Exception;

class Size extends ProductAttribute
{
    /**
     * @param float $megabytes
     * @throws Exception
     */
    public function __construct(protected float $megabytes)
    {
        $this->setMegabytes($this->megabytes);
    }

    /**
     * @param float $megabytes
     * @return void
     * @throws Exception
     */
    public function setMegabytes(float $megabytes): void
    {
        if (!isset($megabytes) || !is_numeric($megabytes)) {
            throw new Exception("Error setting Size MB attribute.");
        }
        $this->megabytes = $megabytes;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'sizemb' => $this->megabytes
        ];
    }
}