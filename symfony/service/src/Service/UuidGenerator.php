<?php

namespace App\Service;

use App\Service\IdGeneratorInterface;
use Symfony\Component\Uid\Uuid;

class UuidGenerator implements IdGeneratorInterface
{

    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}