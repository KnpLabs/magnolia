<?php

declare(strict_types=1);

namespace Infrastructure\DBAL;

use Doctrine\DBAL\Connection;
use Domain\Model\Feed;
use Domain;

class FeedFetcher implements Domain\FeedFetcher
{
    private $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    public function fetchFeeds(string $userId): array
    {
        $sql = 'SELECT * FROM feeds WHERE userId = :userId';
        $stmt = $this->dbal->prepare($sql);
        $stmt->bindValue('userId', $userId);
        $stmt->execute();

        $feedsData = $stmt->fetchAll();

        return array_map(function($data) {
            return new Feed($data['id'], $data['userId']);
        }, $feedsData);
    }
}
