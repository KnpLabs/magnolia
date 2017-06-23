<?php

declare(strict_types=1);

namespace UseCases\ReadFeed;

class Request
{
    /** @var string Repository full name */
    private $repository;

    public function __construct(string $repository)
    {
        $this->repository = $repository;
    }

    public function getRepository(): string
    {
        return $this->repository;
    }
}
