<?php

namespace App\DataProvider;

use Exception;
use JetBrains\PhpStorm\Pure;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class DataProviderConfigurator
{
    public function __construct
    (
        private DataProvider $dataProvider,
        private array $decorators,
        private ContainerInterface $container
    )
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getDecoratedProvider(): DataProviderInterface
    {
        $dataProvider = $this->dataProvider;

        foreach ($this->decorators as $decorator) {
            $dataProvider = $this->container->get($decorator);
            $this->dataProvider = $dataProvider->setProvider($this->dataProvider);
        }

        return $dataProvider;
    }
}