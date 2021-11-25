<?php

use App\DataProvider\Decorator\CacheDecorator;
use App\DataProvider\Decorator\LogDecorator;
use App\DataProvider\Decorator\MySqlDecorator;
use Psr\Container\ContainerInterface;

// Пример зависимостей для контейнера
return [
    CacheDecorator::class => function (ContainerInterface $container) {
        return new CacheDecorator(
            $container->get(Cache::class),
        );
    },

    LogDecorator::class => function (ContainerInterface $container) {
        return new LogDecorator(
              $container->get(Monolog::class),
        );
    },

    MySqlDecorator::class => function (ContainerInterface $container) {
        return new MySqlDecorator(
            $container->get(ConcreteRepository::class),
            $container->get(Flusher::class),
        );
    }
];