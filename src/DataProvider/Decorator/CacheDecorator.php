<?php

namespace App\DataProvider\Decorator;

use App\DataProvider\DataProviderInterface;
use DateTime;
use JetBrains\PhpStorm\Pure;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;

/**
 * Конкретный декоратор, содержит новое поведение(кеш)
 */
class CacheDecorator extends BaseDecorator
{
    #[Pure] public function __construct
    (
        private CacheItemPoolInterface $cache
    )
    {
    }

    /**
     * Декоратор ищет сначала в кеше, если не находит -> в родителе
     * @throws InvalidArgumentException
     */
    public function get(array $request): array
    {
        $cacheKey = $this->getCacheKey($request);
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = parent::get($request);

        $cacheItem
            ->set($result)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );

        return $result;
    }

    private function getCacheKey(array $input): bool|string
    {
        return json_encode($input);
    }
}