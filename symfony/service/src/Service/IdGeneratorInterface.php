<?php

namespace App\Service;

interface IdGeneratorInterface
{
    public function generate(): string;
}