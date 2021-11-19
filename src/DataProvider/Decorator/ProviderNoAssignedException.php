<?php

namespace App\DataProvider\Decorator;

use DomainException;

class ProviderNoAssignedException extends DomainException implements ProviderNoAssignedExceptionInterface
{

}