<?php

declare(strict_types=1);

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Event
{
    /** @var string */
    private $id;

    /** @var array */
    private $payload;

    /** @var \DateTimeInterface */
    private $date;

    /** @var Repository */
    private $repository;

    public function __construct(string $id, array $payload, \DateTimeInterface $date, Repository $repository)
    {
        $this->id         = $id;
        $this->payload    = $payload;
        $this->date       = $date;
        $this->repository = $repository;
    }

    public static function ingest(array $payload, \DateTimeInterface $date, Repository $repository)
    {
        return new self(
            Uuid::uuid4()->toString(),
            $payload,
            $date,
            $repository
        );
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }
}
