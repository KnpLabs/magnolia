<?php

declare(strict_types=1);

namespace Infrastructure\DBAL;

use Doctrine\DBAL\Connection;
use Domain;
use Domain\Model\RawEvent;
use Domain\Model\Repository;

class RawEventRepository implements Domain\RawEventRepository
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function find(string $owner, string $name): array
    {
        $sql = 'SELECT * FROM raw_events WHERE repo_owner = :owner and repo_name = :name';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('owner', $owner);
        $stmt->bindValue('name', $name);
        $stmt->execute();

        $rawEvents = $stmt->fetchAll();

        return array_map(function ($data) use ($owner, $name) {
            return new RawEvent(
                $data['id'],
                json_decode($data['payload'], true) ?: [],
                new \DateTime($data['date']),
                new Repository($owner, $name)
            );
        }, $rawEvents);
    }
}
