<?php

declare(strict_types=1);

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Feed
{
    private $id;

    private $userId;

    public function __construct(string $id, string $name, string $userId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->userId = $userId;
    }

    public static function create(string $name, string $userId): self
    {
        return new self(
            Uuid::uuid4()->toString(),
            $name,
            $userId
        );
    }

    public function getId(): string
    {
        return $this->id;
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
