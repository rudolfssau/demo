<?php

namespace Main\App\Controllers;

abstract class Controller
{
    /**
     * Callable method
     */
    abstract public function __invoke();
}