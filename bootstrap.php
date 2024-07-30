<?php

require __DIR__ . '/vendor/autoload.php';

use Main\Core\Router;
use Main\Core\Container;

/**
 * Exception reporting for front controller.
 */
error_reporting(E_ALL);
set_error_handler('Main\Core\Error::errorHandler');
set_exception_handler('Main\Core\Error::exceptionHandler');

/**
 * Routing presets
 */
$container = new Container();
$serviceDefinitions = require __DIR__ . '/src/Config/DependencyInjection/Config.php';
foreach ($serviceDefinitions as $interface => $implementation) {
    $container->set($interface, $implementation);
}

$router = new Router($container);
$routes = require __DIR__ . '/src/Config/Routes/Routes.php';
foreach ($routes as $route) {
    $router->add($route['path'], ['controller' => $route['controller']], $route['methods']);
}
$result = $router->dispatch($_SERVER['REQUEST_URI']);
if (is_array($result))
{
    echo json_encode($result);
}
