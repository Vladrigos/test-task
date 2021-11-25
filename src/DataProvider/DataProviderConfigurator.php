<?php

namespace App\DataProvider;

use App\DataProvider\Decorator\BaseDecorator;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Конфигуратор для дата провайдера, собирает все декораторы и оборачивает основной
 */
class DataProviderConfigurator
{

    public function __construct
    (
//      Основной дата провайдер
        private DataProvider $dataProvider,
        /**
         * Массив неймспейсов применяемых декораторов в формате:
         * [
         *      LogDecorator::class,
         *      MySqlDecorator::class,
         *      CacheDecorator::class
         * ]
         * Порядок важен(именно в таком порядке будут оборачиваться)
         */
        private array $decorators,
        private ContainerInterface $container
    )
    {
    }

    /**
     * Возращает обёрнутую версию дата провайдера во все декораторы
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function getDecoratedProvider(): DataProviderInterface
    {
        $dataProvider = $this->dataProvider;

        foreach ($this->decorators as $decorator) {
            if (!class_exists($decorator)) {
                throw new Exception(sprintf('Decorator %s not exists', $decorator));
            }
            $dataProvider = $this->container->get($decorator);
            if (!($dataProvider instanceof BaseDecorator)) {
                throw new Exception('Decorator %s must be instance of %s', $decorator, BaseDecorator::class);
            }

            $this->dataProvider = $dataProvider->setProvider($this->dataProvider);
        }

        return $dataProvider;
    }
}
