<?php

declare(strict_types=1);

namespace Domain;

interface FeedFetcher
{
    public function fetchFeeds(string $userId): array;
}
