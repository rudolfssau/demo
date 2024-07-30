<?php

namespace Main\Core;

use Main\Core\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionException;
use ReflectionParameter;
use ReflectionClass;
use ReflectionUnionType;
use ReflectionNamedType;

class Container implements ContainerInterface
{

    /**
     * Empty array of entries.
     *
     * @var array
     */
    private array $entries = [];

    /**
     * Retrieves entry from the container.
     *
     * @param string $id
     * @return mixed
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            if (is_callable($entry)) {
                return $entry($this);
            }
            $id = $entry;
        }
        return $this->resolve($id);
    }

    /**
     * Checks if entry is present.
     *
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    /**
     * Sets entry.
     *
     * @param string $id
     * @param callable|string $concrete
     * @return void
     */
    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * Responsible for calling the right classes.
     *
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function resolve(string $id): mixed
    {
        $reflectionClass = new ReflectionClass($id);
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Given class is not instantiatable!");
        }

        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id;
        }

        $dependencies = array_map(function (ReflectionParameter $param) use ($id) {
            $parameterName = $param->getName();
            $parameterType = $param->getType();
            if (!$parameterType) {
                throw new ContainerException("No parameter type-hint provided for: " . $parameterName . " in class: " . $id);
            }
            if ($parameterType instanceof ReflectionUnionType) {
                throw new ContainerException("Parameter type-hint provided for: " . $parameterName . " in class: " . $id . " is not a class type-hint, union type-hint provided");
            }
            if ($parameterType instanceof ReflectionNamedType && !$parameterType->isBuiltin()) {
                return $this->get($parameterType->getName());
            } else {
                throw new ContainerException("Invalid parameter provided for: " . $parameterName . " in class: " . $id);
            }
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}