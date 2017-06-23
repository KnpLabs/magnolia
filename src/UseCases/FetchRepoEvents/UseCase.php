<?php

declare(strict_types=1);

namespace UseCases\FetchRepoEvents;

use Domain\RawEventFetcher;
use Domain\RawEventPersister;
use Domain\Model\RawEvent;
use Domain\Model\Repository;

class UseCase
{
    /** @var RawEventFetcher */
    private $fetcher;

    /** @var RawEventPersister */
    private $persister;

    /**
     * @param RawEventFetcher $fetcher
     */
    public function __construct(RawEventFetcher $fetcher, RawEventPersister $persister)
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
            return RawEvent::ingest(
                $raw,
                new \DateTime($raw['created_at']),
                Repository::fromFullName($raw['repo']['name'])
            );
        }, $fetched);

        $this->persister->saveMany($events);

        return Response::succeeded(count($events));
    }
}
