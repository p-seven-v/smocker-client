<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Response;

use P7v\SmockerClient\Domain\Mock;

final class MocksResponse
{
    /**
     * @param list<Mock> $mocks
     */
    public function __construct(
        public readonly array $mocks,
    ) {}
}
