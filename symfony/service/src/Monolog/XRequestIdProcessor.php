<?php

namespace App\Monolog;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class XRequestIdProcessor implements ProcessorInterface
{
    public function __construct(
        private RequestStack $requestStack
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function __invoke(LogRecord $record): LogRecord
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($request instanceof Request) {
            $this->applyXRequestID($request, $record);
        }

        return $record;
    }

    private function applyXRequestID(Request $request, LogRecord &$logRecord): void
    {
        if ($request->headers->has('X-Request-ID')) {
            $logRecord->extra['x_request_id'] = $request->headers->get('X-Request-ID');
        }
    }
}