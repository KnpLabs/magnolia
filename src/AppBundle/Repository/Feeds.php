<?php

namespace AppBundle\Repository;

use Doctrine\DBAL\Connection;
use AppBundle\Domain\Model\Feed;

class Feeds
{
    private $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    public function getAllFeeds(string $userId)
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
