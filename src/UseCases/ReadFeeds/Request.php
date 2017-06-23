<?php

declare(strict_types=1);

namespace UseCases\ReadFeeds;

class Request
{
    /** @var string */
    private $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
