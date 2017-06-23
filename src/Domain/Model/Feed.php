<?php

declare(strict_types=1);

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Feed
{
    private $id;

    private $userId;

    public function __construct(string $userId, string $id = null)
    {
        if ($id) {
            $this->id = $id;
        } else {
            $this->id = Uuid::uuid4()->toString();
        }
        $this->userId = $userId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
