<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

interface ApiRequestInterface
{
    public function getMethod(): string;

    public function getRoute(): string;

    public function getQueryParameters(): array;

    public function getBody();
}
