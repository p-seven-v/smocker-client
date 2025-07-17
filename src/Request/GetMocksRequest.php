<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

final class GetMocksRequest implements ApiRequestInterface
{
    use GetMethodTrait;

    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $session = null,
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
