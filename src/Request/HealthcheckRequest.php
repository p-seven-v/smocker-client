<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

final class HealthcheckRequest extends GetRequest
{
    public function getRoute(): string
    {
        return '/version';
    }

    public function getQueryParameters(): array
    {
        return [];
    }
}
