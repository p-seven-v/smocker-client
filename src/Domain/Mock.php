<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Domain;

final class Mock
{
    public function __construct(
        public readonly Request $request,
        public readonly Response $response,
    ) {}
}
