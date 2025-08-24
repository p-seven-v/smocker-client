<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

use Override;

abstract class PostRequest implements ApiRequestInterface {
    #[Override]
    public function getMethod(): string
    {
        return 'POST';
    }
}
