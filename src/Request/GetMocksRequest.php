<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

/**
 * @api
 */
final class GetMocksRequest extends GetRequest
{
    public function __construct(
        private readonly ?string $id = null,
        private readonly ?string $session = null,
    ) {}

    public function getRoute(): string
    {
        return 'mocks';
    }

    public function getQueryParameters(): array
    {
        return array_filter(
            [
                'id' => $this->id,
                'session' => $this->session,
            ],
        );
    }

    /**
     * @return null
     */
    public function getBody(): mixed
    {
        return null;
    }
}
