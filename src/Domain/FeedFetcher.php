<?php

declare(strict_types=1);

namespace Domain;

interface FeedFetcher
{
    public function fetchFeeds(string $userId): array;

    public function fetchFeed(string $feedId): Domain\Model\Feed?;
}
