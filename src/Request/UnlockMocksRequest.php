<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

final class UnlockMocksRequest implements ApiRequestInterface
{
    use PostMethodTrait;

    /**
     * @param non-empty-list<non-empty-string> $mocksIds
     */
    public function __construct(private array $mocksIds)
    {
    }

    public function getRoute(): string
    {
        return 'mocks/unlock';
    }

    public function getQueryParameters(): array
    {
        return [];
    }

    public function getBody(): mixed
    {
        return $this->mocksIds;
    }
}
