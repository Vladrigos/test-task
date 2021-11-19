<?php

namespace App\DataProvider;

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