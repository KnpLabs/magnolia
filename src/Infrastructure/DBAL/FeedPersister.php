<?php

declare(strict_types=1);

namespace Infrastructure\DBAL;

use Domain;
use Domain\Model;
use Doctrine\DBAL\Connection;

class FeedPersister implements Domain\FeedPersister
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Model\Feed $feed)
    {
        $stmt = $this->connection->insert(
            Tables::FEEDS,
            [
                'id' => $feed->getId(),
                'name' => $feed->getName(),
                'userId' => $feed->getUserId(),
                'repositories' => array_map(function($repository) {
                    return $repository->getFullName();
                }, $feed->getRepositories())
            ],
            [
                'repositories' => 'json'
            ]
        );
    }
}
