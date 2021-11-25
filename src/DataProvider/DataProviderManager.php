<?php

namespace App\DataProvider;

/**
 * Клиентский код, получает внешний источник данных, не знает как именно будут обрабатываться данные
 */
class DataProviderManager
{
    public function __construct
    (
        private array $data,
        private DataProviderInterface $dataProvider
    )
    {
    }

    public function get(): array
    {
        return $this->dataProvider->get($this->data);
    }
}
