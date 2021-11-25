<?php

namespace App\DataProvider\Decorator;

use App\DataProvider\FlusherInterface;
use App\DataProvider\SomeConcreteRepositoryInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Конкретный декоратор, содержит новое поведение(данные из mysql)
 */
class MySqlDecorator extends BaseDecorator
{
    #[Pure] public function __construct
    (
        private SomeConcreteRepositoryInterface $repository,
        private FlusherInterface $flusher,
    )
    {
    }

    /**
     * Декоратор ищет сначала в репозитории, если не находит -> в родителе
     */
    public function get(array $request): array
    {
        $result = $this->repository->findByGuid($request['guid']);

        if ($result) {
            return $result->toArray();
        }

        $result = parent::get($request);

        $this->repository->add($result);

        $this->flusher->flush();

        return $result;
    }
}