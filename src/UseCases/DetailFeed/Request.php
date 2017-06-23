<?php

declare(strict_types=1);

namespace UseCases\DetailFeed;

class Request
{
    private $feedId;

    public function __construct(string $feedId)
    {
        $this->feedId = $feedId;
    }

    public function getFeedId(): string
    {
        return $this->feedId;
    }
}
