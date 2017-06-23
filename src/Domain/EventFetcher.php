<?php

namespace Domain;

interface EventFetcher
{
    public function fetchEvents(string $owner, string $repository): array;
}
