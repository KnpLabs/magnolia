<?php

declare(strict_types=1);

namespace UseCases\TransformRepoEvents;

class Request
{
    /** @var string Repository full name (i.e. KnpLabs/magnolia) */
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
