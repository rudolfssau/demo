<?php

/**
 * Config file for route configuration
 *
 * @return array{
 *   path: string,
 *   controller: string,
 *   method: array
 *  }
 *
 */
return [
    [
        'path' => '/',
        'controller' => 'Home',
        'methods' => ['GET']
    ],
    [
        'path' => '/home/delete',
        'controller' => 'Delete',
        'methods' => ['POST']
    ],
    [
        'path' => '/check/check',
        'controller' => 'Check',
        'methods' => ['GET']
    ],
    [
        'path' => '/add-product',
        'controller' => 'Products',
        'methods' => ['GET', 'POST']
    ],
    [
        'path' => '/posts/insert',
        'controller' => 'Post',
        'methods' => ['POST']
    ],
    [
        'path' => '/get/returnJson',
        'controller' => 'Get',
        'methods' => ['GET']
    ],
];