<?php

namespace App\DataProvider\Decorator;

use App\DataProvider\BaseDecoratorInterface;
use App\DataProvider\DataProviderInterface;

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