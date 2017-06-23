<?php

declare(strict_types=1);

namespace UseCases\DetailFeed;

use Domain\FeedFetcher;
use Domain\RawEventFetcher;

class UseCase
{
    private $feedFetcher;

    private $eventFetcher;

    public function __construct(FeedFetcher $feedFetcher, RawEventFetcher $eventFetcher)
    {
        $this->feedFetcher = $feedFetcher;
        $this->eventFetcher = $eventFetcher;
    }

    public function __invoke(Request $request): Response
    {
        $feed = $this->feedFetcher->fetchFeed($request->getFeedId());

        if (!$feed) {
            return Response::failed([
                'Feed not found'
            ]);
        }

    }
}
