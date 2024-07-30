<?php

declare(strict_types=1);

namespace Main\Core;

use Exception;

class Router
{
    /**
     * Stores routes.
     *
     * @var array
     */
    protected array $routes = [];

    /**
     * Stores parameters.
     *
     * @var array
     */
    protected array $params = [];

    /**
     * Regex for changing "/" in the provided URL.
     */
    const REGEX_DIR = '/\//';
    const REGEX_URL = '\\/';

    /**
     * Regex for capture group catching inside URL.
     */
    const REGEX_LOWERCASE = '/\{([a-z]+)/';
    const REGEX_CAPTUREGROUP = '(?P<\1>[a-z]+)';

    /**
     * Dependency injection container.
     *
     * @param Container $container
     */
    public function __construct(private readonly Container $container)
    {
    }

    /**
     * add() function gets passed in routes from the entry point, which later on get divided into two arrays - $routes, $params.
     *
     * @param string $route
     * @param array $params
     * @param array $methods
     * @return void
     */
    public function add(string $route, array $params = [], array $methods = []): void
    {
        $route = preg_replace(self::REGEX_DIR, self::REGEX_URL, $route);
        $route = preg_replace(self::REGEX_LOWERCASE, self::REGEX_CAPTUREGROUP, $route);
        $route = '/^' . $route . '$/i';
        $params['methods'] = $methods;
        $this->routes[$route] = $params;
    }

    /**
     * match() checks if the route from the URL matches with any of the pre-defined routes.
     *
     * @param string $url
     * @param string $method
     * @return bool
     * @throws Exception
     */
    public function match(string $url, string $method): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                if (in_array($method, $params['methods'], true)) {
                    foreach ($matches as $key => $match) {
                        $params[$key] = $match;
                    }
                    $this->params = $params;
                    return true;
                }
                http_response_code(405);
                throw new Exception("HTTP method not allowed");
            }
        }
        return false;
    }

    /**
     * dispatch() is responsible for calling the correct controller and route after they have been processed in the correct format.
     *
     * @throws Exception
     */
    public function dispatch(string $url): mixed
    {
        if (!$this->match($url, $_SERVER['REQUEST_METHOD'])) {
            http_response_code(404);
            throw new Exception("No result found");
        }

        $controller = $this->params['controller'];
        $controller = 'Main\\App\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            http_response_code(404);
            throw new Exception("Controller class $controller not found...");
        }

        return call_user_func($this->container->get($controller));
    }
}