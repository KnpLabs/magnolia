<?php

declare(strict_types=1);

namespace UseCases\FetchRepoEvents;

use Domain\EventFetcher;
use Domain\EventPersister;
use Domain\Model\Event;
use Domain\Model\Repository;

class UseCase
{
    /** @var EventFetcher */
    private $fetcher;

    /** @var EventPersister */
    private $persister;

    /**
     * @param EventFetcher $fetcher
     */
    public function __construct(EventFetcher $fetcher, EventPersister $persister)
    {
        $this->fetcher = $fetcher;
        $this->persister = $persister;
    }

    /**
     * @TODO: get the list of the repository to fetch from feeds -> repo relationships
     */
    public function __invoke(Request $request)
    {
        if (strpos($request->getRepository(), '/') === false) {
            return Response::failed(['Missing repository name.']);
        }

        list($owner, $repo) = explode('/', $request->getRepository());

        $fetched = $this->fetcher->fetchEvents($owner, $repo);
        $events = array_map(function ($raw) {
            return Event::ingest(
                $raw,
                new \DateTime($raw['created_at']),
                Repository::fromFullName($raw['repo']['name'])
            );
        }, $fetched);

        $this->persister->saveMany($events);

        return Response::succeeded(count($events));
    }
}
