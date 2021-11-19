<?php

use App\DataProvider\DataProvider;
use App\DataProvider\DataProviderConfigurator;
use App\DataProvider\DataProviderManager;
use App\DataProvider\Decorator\LogDecorator;
use App\DataProvider\Decorator\MySqlDecorator;

require dirname(__DIR__) . '/vendor/autoload.php';

$data = ['some' => 'data'];

$dataProvider = new DataProvider(
    host: 'host',
    user: 'user',
    password: 'password'
);

$container = new Container(require __DIR__ . 'dependencies.php');

$configurator = new DataProviderConfigurator(
    $dataProvider,
    [
        MySqlDecorator::class,
        LogDecorator::class,
    ],
    $container
);

$dataProviderManager = new DataProviderManager(
    $data,
    $configurator->getDecoratedProvider()
);

$dataProviderManager->get();