<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\WriteLogEntry;
use Psr\Log\LogLevel;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: "Log",
    description: "Write a log entry",
    operations: [
        new Post(controller: WriteLogEntry::class),
    ]
)]
class LogEntry
{
    #[Assert\NotBlank]
    #[ApiProperty(
        example: 'This message will be logged.',
    )]
    public string $message = '';

    #[Assert\Choice(
        options: [
            LogLevel::EMERGENCY,
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::ERROR,
            LogLevel::WARNING,
            LogLevel::NOTICE,
            LogLevel::INFO,
            LogLevel::DEBUG,
        ],
    )]
    #[ApiProperty(description: "PSR log level")]
    public string $logLevel = LogLevel::DEBUG;
}