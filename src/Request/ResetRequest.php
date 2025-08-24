<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

use Override;

/**
 * @api
 */
final class ResetRequest extends PostRequest
{
    public function __construct(private bool $force = false)
    {
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
