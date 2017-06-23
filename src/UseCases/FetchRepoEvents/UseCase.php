<?php

declare(strict_types=1);

namespace UseCases\FetchRepoEvents;

use Domain\EventFetcher;

class UseCase
{
    /** @var EventFetcher */
    private $fetcher;

    /**
     * @param EventFetcher $fetcher
     */
    public function __construct(EventFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function __invoke(Request $request)
    {
        if (strpos($request->getRepository(), '/') === false) {
            return Response::failed(['Missing repository name.']);
        }

        list($owner, $repo) = explode('/', $request->getRepository());

        $events = $this->fetcher->fetchEvents($owner, $repo);

        return Response::succeeded(count($events));
    }
}
