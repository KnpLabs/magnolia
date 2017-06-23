<?php

declare(strict_types=1);

namespace UseCases\FetchRepoEvents;

use UseCases\CanHaveErrors;

class Response
{
    use CanHaveErrors;

    /** @var int */
    private $fetchedEvents;

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

    public function getNumberOfFetchedEvents(): int
    {
        return $this->fetchedEvents;
    }
}
