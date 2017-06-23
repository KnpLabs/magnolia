<?php

declare(strict_types=1);

namespace UseCases\CreateFeed;

class Request
{
    /** @var string */
    private $name;

    /** @var string */
    private $userId;

    public function __construct(string $name, string $userId)
    {
        $this->name   = $name;
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
