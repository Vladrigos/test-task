<?php

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    public function __construct
    (
        private array $definitions,
    )
    {
    }

    public function get(string $id)
    {
        // get service with id from container
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }
}