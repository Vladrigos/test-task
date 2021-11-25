<?php

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    public function __construct
    (
        private array $definitions,
    )
    {
    }

    /**
     *  @throws NotFoundExceptionInterface
     */
    public function get(string $id)
    {
        // get service with id from container
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }
}