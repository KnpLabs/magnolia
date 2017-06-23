<?php

declare(strict_types=1);

namespace UseCases\ReadFeed;

use Domain\Model;
use UseCases\CanHaveErrors;

class Response
{
    use CanHaveErrors;

    /** @var array|Model\GenericEvent[] */
    private $events;

    private function __construct(array $events)
    {
        $this->events = $events;
    }

    public static function succeeded(array $events): self
    {
        return new self($events, []);
    }

    public static function failed(array $errors): self
    {
        return new self([], $errors);
    }

    public function getEvents()
    {
        return $this->events;
    }
}
