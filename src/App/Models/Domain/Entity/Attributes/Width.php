<?php

namespace Main\App\Models\Domain\Entity\Attributes;

use Exception;
use Main\App\Models\Domain\Interface\IsAttribute;

class Width implements IsAttribute
{
    /**
     * Defined key for attribute.
     */
    const attributeCode = "widthcm";

    /**
     * @var array
     */
    private array $value = [];

    /**
     * @param string $value
     * @return void
     * @throws Exception
     */
    public function setValue(string $value): void
    {
        if (!isset($value) || !is_numeric($value)) {
            throw new Exception("Error setting Width attribute.");
        }
        $this->value[self::attributeCode] = $value;
    }

    /**
     * @return mixed
     */
    public function getValue(): array
    {
        return $this->value;
    }
}