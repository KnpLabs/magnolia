<?php

declare(strict_types=1);

namespace UseCases\CreateFeed;

use Domain\FeedPersister;
use Domain\Model\Feed;
use Domain\Model\Repository;

class UseCase
{
    /** @var FeedPersister */
    private $persister;

    public function __construct(FeedPersister $persister)
    {
        $this->persister = $persister;
    }

    public function __invoke(Request $request): Response
    {
        $errors = $this->validateRequest($request);

        if (!empty($errors)) {
            return Response::failed($errors);
        }

        $repositories = array_map([Repository::class, 'fromFullName'], $request->getRepositories());
        $feed = Feed::create($request->getName(), $request->getUserId(), $repositories);

        $this->persister->save($feed);

        return Response::succeeded($feed->getId());
    }

    private function validateRequest(Request $request): array
    {
        $errors = [];
        $name = $request->getName();
        $userId = $request->getUserId();

        if (empty($name)) {
            $errors[] = 'Empty feed name.';
        }
        if (empty($userId)) {
            $errors[] = 'User is mandatory.';
        }

        return $errors;
    }
}
