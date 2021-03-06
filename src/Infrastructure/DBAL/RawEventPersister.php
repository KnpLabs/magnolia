<?php

declare(strict_types=1);

namespace Infrastructure\DBAL;

use Doctrine\DBAL\Connection;
use Domain;

class RawEventPersister implements Domain\RawEventPersister
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param array|Domain\Model\RawEvent[] $events
     */
    public function saveMany(array $events)
    {
        foreach ($events as $event) {
            $this->connection->insert(Tables::RAW_EVENTS, [
                'id'         => $event->getId(),
                'payload'    => $event->getPayload(),
                'date'       => $event->getDate(),
                'repo_owner' => $event->getRepository()->getOwner(),
                'repo_name'  => $event->getRepository()->getName(),
            ], [
                'payload' => 'json',
                'date' => 'datetime',
            ]);
        }
    }
}
