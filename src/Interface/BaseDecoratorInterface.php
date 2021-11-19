<?php

namespace App\DataProvider;

interface BaseDecoratorInterface
{
    public function setProvider(DataProviderInterface $provider): static;
}