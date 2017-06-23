<?php

declare(strict_types=1);

namespace UseCases\ReadFeeds;

use Domain\FeedFetcher;

class UseCase
{
    /** @var FeedFetcher */
    private $fetcher;

    public function __construct(FeedFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function __invoke(Request $request)
    {
        $feeds = $this->fetcher->fetchFeeds($request->getUserId());

        return Response::succeeded($feeds);
    }
}
