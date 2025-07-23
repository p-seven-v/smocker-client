<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

use Override;

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

    #[Override]
    public function getRoute(): string
    {
        return 'reset';
    }

    #[Override]
    public function getQueryParameters(): array
    {
        return [
            'force' => $this->force ? 'true' : 'false',
        ];
    }

    #[Override]
    public function getBody(): mixed
    {
        return null;
    }
}
