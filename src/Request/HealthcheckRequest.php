<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

final class HealthcheckRequest implements ApiRequestInterface
{
    use GetMethodTrait;

    public function getRoute(): string
    {
        return '/version';
    }

    public function getQueryParameters(): array
    {
        return [];
    }

    /**
     * @return null
     */
    public function getBody(): mixed
    {
        return null;
    }
}
