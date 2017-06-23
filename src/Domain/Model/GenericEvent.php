<?php

declare(strict_types=1);

namespace Domain\Model;

class GenericEvent
{
    /** @var string */
    private $id;

    /** @var string */
    private $type;

    /** @var string */
    private $repository;

    /** @var \DateTimeInterface */
    private $date;

    /** @var string */
    private $url;

    public function __construct(string $id, string $type, Repository $repository, \DateTimeInterface $date, string $url = null)
    {
        $this->id = $id;
        $this->type = $type;
        $this->repository = $repository;
        $this->date = $date;
        $this->url = $url;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
