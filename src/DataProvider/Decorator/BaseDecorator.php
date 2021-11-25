<?php

namespace App\DataProvider\Decorator;

use App\DataProvider\BaseDecoratorInterface;
use App\DataProvider\DataProviderInterface;

/**
 * Базовый декоратор: хранит ссылку на обьект-компонент и конкретный декоратор над ним
 */
class BaseDecorator implements DataProviderInterface, BaseDecoratorInterface
{
    private DataProviderInterface $provider;

    public function get(array $request): array
    {
        if (!isset($this->provider)) {
            throw new ProviderNoAssignedException();
        }

        return $this->provider->get($request);
    }

    public function setProvider(DataProviderInterface $provider): static
    {
        $this->provider = $provider;

        return $this;
    }
}