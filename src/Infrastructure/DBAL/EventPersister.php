<?php

declare(strict_types=1);

namespace Infrastructure\DBAL;

use Doctrine\DBAL\Connection;
use Domain;
use Domain\Model\GenericEvent;

class EventPersister implements Domain\EventPersister
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(GenericEvent $event)
    {
        $this->connection->insert(Tables::EVENTS, [
            'id'         => $event->getId(),
            'type'       => $event->getType(),
            'date'       => $event->getDate(),
            'repo_owner'  => $event->getRepository()->getOwner(),
            'repo_name'  => $event->getRepository()->getName(),
        ], [
            'date' => 'datetime',
        ]);
    }
}
