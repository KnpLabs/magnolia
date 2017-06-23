<?php

namespace Domain;

use Domain\Model\Feed;

interface EventRepository
{
    public function findEvents(string $feedId): Feed;
}
