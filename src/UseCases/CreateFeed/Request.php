<?php

declare(strict_types=1);

namespace UseCases\CreateFeed;

class Request
{
    /** @var string */
    private $name;

    /** @var string */
    private $userId;

    /** @var array */
    private $repositories;

    public function __construct(string $name, string $userId, array $repositories)
    {
        $this->name         = $name;
        $this->userId       = $userId;
        $this->repositories = $repositories;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getRepositories(): array
    {
        return $this->repositories;
    }
}
