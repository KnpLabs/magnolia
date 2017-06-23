<?php

declare(strict_types=1);

namespace Infrastructure\DBAL;

use Doctrine\DBAL\Connection;
use Domain;
use Domain\Model\GenericEvent;
use Domain\Model\Repository;

class DetailedFeedRepository implements Domain\FeedRepository
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getFeed(string $feedId): array
    {
        $sql = 'SELECT * FROM feed WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id', $feedId);
        $stmt->execute();

        $feed = $stmt->fetch();

        return new Domain\Model\Feed(
            
        );
    }
}
