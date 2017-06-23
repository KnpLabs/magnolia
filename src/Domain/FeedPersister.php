<?php

declare(strict_types=1);

namespace Domain;

use Domain\Model;

interface FeedPersister
{
    public function save(Model\Feed $feed);
}
