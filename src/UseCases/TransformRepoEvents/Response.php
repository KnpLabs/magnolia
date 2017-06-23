<?php

declare(strict_types=1);

namespace UseCases\TransformRepoEvents;

use UseCases\CanHaveErrors;

class Response
{
    use CanHaveErrors;

    /** @var int */
    private $transformedEvents;

    private function __construct(int $transformedEvents, array $errors)
    {
        $this->transformedEvents = $transformedEvents;
        $this->errors = $errors;
    }

    public static function succeeded(int $transformedEvents): self
    {
        return new self($transformedEvents, []);
    }

    public static function failed(array $errors): self
    {
        return new self(0, $errors);
    }

    public function getNumberOfTransformedEvents(): int
    {
        return $this->transformedEvents;
    }
}
