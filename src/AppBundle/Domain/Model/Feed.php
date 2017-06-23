<?php

namespace AppBundle\Domain\Model;

use Ramsey\Uuid\Uuid;

class Feed
{
    private $id;

    private $userId;

    public function __construct(string $userId, string $id = null)
    {
        if ($id) {
            $this->id = $id;
        } else {
            $this->id = Uuid::uuid4()->toString();
        }
        $this->userId = $userId;
    }
}
