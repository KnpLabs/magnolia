<?php

declare(strict_types=1);

namespace UseCases\FetchRepoEvents;

class Response
{
    /** @var int */
    private $fetchedEvents;

    /** @var array|string[] */
    private $errors;

    private function __construct(int $fetchedEvents, array $errors)
    {
        $this->fetchedEvents = $fetchedEvents;
        $this->errors = $errors;
    }

    public static function succeeded(int $fetchedEvents): self
    {
        return new self($fetchedEvents, []);
    }

    public static function failed(array $errors): self
    {
        return new self(0, $errors);
    }

    public function isSuccessful(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getNumberOfFetchedEvents(): int
    {
        return $this->fetchedEvents;
    }
}
