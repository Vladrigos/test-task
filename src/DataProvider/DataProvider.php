<?php

namespace App\DataProvider;

/**
 * Конкретный компонент, содержит базовое поведение, которое впоследствии будем оборачивать
 */
class DataProvider implements DataProviderInterface
{
    public function __construct
    (
        private string $host,
        private string $user,
        private string $password
    )
    {
    }

    public function get(array $request): array
    {
        // returns a response from external service
        return [];
    }
}
