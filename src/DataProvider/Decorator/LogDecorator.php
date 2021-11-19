<?php

namespace App\DataProvider\Decorator;

use Exception;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;

class LogDecorator extends BaseDecorator
{
    #[Pure] public function __construct
    (
        private LoggerInterface $logger,
    )
    {
    }

    public function get(array $request): array
    {
        try {
            $result = parent::get($request);

            $this->logger->info('Data get successfully!', ['result_uuid' => $result['uuid']]);

            return $result;
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage(), ['exception' => $exception]);
        }
    }
}