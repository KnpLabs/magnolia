<?php

declare(strict_types=1);

namespace Domain\Model;

class Repository
{
    private $owner;

    private $name;

    public function __construct(string $owner, string $name)
    {
        $this->owner = $owner;
        $this->name  = $name;
    }

    public static function fromFullName(string $fullName): self
    {
        if (strpos($fullName, '/') === false) {
            throw new \InvalidArgumentException('The repository full name should contain a slash.');
        }

        return new self(...explode('/', $fullName));
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFullName(): string
    {
        return $this->owner .'/'. $this->name;
    }
}
