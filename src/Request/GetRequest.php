<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

use Override;

abstract class GetRequest implements ApiRequestInterface
{
    #[Override]
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @return null
     */
    #[Override]
    public function getBody(): mixed
    {
        return null;
    }
}
