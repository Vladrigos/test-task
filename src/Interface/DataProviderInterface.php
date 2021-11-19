<?php

namespace App\DataProvider;

interface DataProviderInterface
{
    public function get(array $request): array;
}