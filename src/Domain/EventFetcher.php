<?php

declare(strict_types=1);

namespace Domain;

interface EventFetcher
{
    public function fetchEvents(string $owner, string $repository): array;
}
