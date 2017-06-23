<?php

declare(strict_types=1);

namespace UseCases\ReadFeed;

use Domain\DetailedFeedRepository;
use Domain\FeedFetcher;

class UseCase
{
    /** @var DetailedFeedRepository */
    private $repository;

    public function __construct(DetailedFeedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        if (strpos($request->getRepository(), '/') === false) {
            return Response::failed(['Invalid repository name.']);
        }

        list($owner, $name) = explode('/', $request->getRepository());
        $events = $this->repository->findEvents($owner, $name);

        return Response::succeeded($events);
    }
}
