<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Response;

final class ResetResponse
{
    public function __construct(private string $message)
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
