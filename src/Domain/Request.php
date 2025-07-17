<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Domain;

final class Request
{
    public function __construct(
        public readonly RequestPath $path,
        public readonly RequestMethod $method,
    ) {}

}
