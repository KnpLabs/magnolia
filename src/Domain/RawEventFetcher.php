<?php

declare(strict_types=1);

namespace Domain;

interface RawEventFetcher
{
    public function fetchEvents(string $owner, string $repository): array;
}
