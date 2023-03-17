<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

final class ResetRequest implements ApiRequestInterface
{
    use PostMethodTrait;

    public function __construct(private bool $force = false)
    {
    }

    public function isForced(): bool
    {
        return $this->force;
    }

    public function getRoute(): string
    {
        return 'reset';
    }

    public function getQueryParameters(): array
    {
        return [
            'force' => $this->force ? 'true' : 'false',
        ];
    }

    public function getBody(): mixed
    {
        return null;
    }
}
