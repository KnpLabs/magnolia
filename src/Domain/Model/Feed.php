<?php

declare(strict_types=1);

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Feed
{
    private $id;

    private $userId;

    /** @var array|Repository[] Should be a filter */
    private $repositories;

    /**
     * @param string             $id
     * @param string             $name
     * @param string             $userId
     * @param array|Repository[] $repositories
     */
    public function __construct(string $id, string $name, string $userId, array $repositories)
    {
        $this->id = $id;
        $this->name = $name;
        $this->userId = $userId;
        $this->repositories = $repositories;
    }

    /**
     * @param string             $name
     * @param string             $userId
     * @param array|Repository[] $repositories
     *
     * @return Feed
     */
    public static function create(string $name, string $userId, array $repositories): self
    {
        return new self(
            Uuid::uuid4()->toString(),
            $name,
            $userId,
            $repositories
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

    public function getRepositories(): array
    {
        return $this->repositories;
    }
}
