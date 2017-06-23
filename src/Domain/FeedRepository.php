<?php

namespace Domain;

use Domain\Model\Feed;

interface FeedRepository
{
    public function getFeed(string $feedId): Feed;
}
