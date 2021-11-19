<?php

namespace App\DataProvider;

interface SomeConcreteRepositoryInterface
{
    public function add(SomeEntity $entity): void;

    public function findByGuid(Guid $guid): ?SomeEntity;
}