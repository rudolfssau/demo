<?php

namespace Main\App\Models\Domain\Interface;

interface IsAttribute
{
    /**
     * Used to set attribute specific value. Method accepts both strings and arrays, based on the number of attributes.
     *
     * @param string $value
     * @return void
     */
    public function setValue(string $value): void;

    /**
     * Used to fetch attribute specific value.
     *
     * @return mixed
     */
    public function getValue(): mixed;
}