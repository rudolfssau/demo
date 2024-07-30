<?php

use Main\App\Models\Domain\Repository\AttributeRepositoryInterface;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;
use Main\App\Models\Persistence\AttributeMySQLRepository;
use Main\App\Models\Persistence\ProductMySQLRepository;

/**
 * Defines the Interface and Class to be used in container.
 */
return [
    ProductRepositoryInterface::class => ProductMySQLRepository::class,
    AttributeRepositoryInterface::class => AttributeMySQLRepository::class,
];