<?php

declare(strict_types=1);

namespace UseCases\DetailFeed;

use UseCases\CanHaveErrors;

class Response
{
    use CanHaveErrors;

    private function __construct(array $events, array $errors)
    {
        $this->events = $events;
        $this->errors = $errors;
    }

    public static function succeeded(array $events): self
    {
        return new self($events, []);
    }

    public static function failed(array $errors): self
    {
        return new self([], $errors);
    }

    public function getEvents(): array
    {
        return $this->events;
    }
}
