<?php

use App\DataProvider\DataProvider;
use App\DataProvider\DataProviderConfigurator;
use App\DataProvider\DataProviderManager;
use App\DataProvider\Decorator\CacheDecorator;
use App\DataProvider\Decorator\LogDecorator;
use App\DataProvider\Decorator\MySqlDecorator;

require dirname(__DIR__) . '/vendor/autoload.php';

$container = new Container(require __DIR__ . 'dependencies.php');

// Данные для отправки
$data = ['some' => 'data'];

$dataProvider = new DataProvider(
    host: 'host',
    user: 'user',
    password: 'password'
);

$configurator = new DataProviderConfigurator(
    $dataProvider,
    [
        LogDecorator::class,
        MySqlDecorator::class,
        CacheDecorator::class,
    ],
    $container
);

$dataProviderManager = new DataProviderManager(
    $data,
    $configurator->getDecoratedProvider()
);

//В итоге получит данные по цепочке из (MySql, Cache, Api) обёрнутые логгером при успешном и не успешном получении данных
$dataProviderManager->get();