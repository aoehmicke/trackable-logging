<?php

namespace App\Controller;

use App\Entity\LogEntry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WriteLogEntry extends AbstractController
{
    public function __invoke(LogEntry $logEntry, ValidatorInterface $validator, LoggerInterface $logger): JsonResponse
    {
        $errors = $validator->validate($logEntry);

        if (count($errors) > 0) {
           $response = $this->json($errors);
           $response->setStatusCode(442);

           return $response;
        }

        $logger->log($logEntry->logLevel, $logEntry->message);

        return $this->json($logEntry);
    }
}