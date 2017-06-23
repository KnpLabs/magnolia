<?php

declare(strict_types=1);

namespace UseCases\TransformRepoEvents;

use Domain\RawEventFetcher;
use Domain\EventPersister;
use Domain\Model\RawEvent;
use Domain\Model\Repository;
use Domain\RawEventRepository;
use Domain\RawEventTransformer;

class UseCase
{
    /** @var RawEventTransformer */
    private $transformer;

    /** @var EventPersister */
    private $persister;

    public function __construct(
        RawEventRepository $repository,
        RawEventTransformer $transformer,
        EventPersister $persister
    ) {
        $this->repository = $repository;
        $this->transformer = $transformer;
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

        $rawEvents = $this->repository->find($owner, $repo);
        $transformation = [];

        foreach ($rawEvents as $rawEvent) {
            $transformation[] = $this->handleRawEvent($rawEvent);
        }

        $successful = count(array_filter($transformation));
        $failed = count($rawEvents) - $successful;

        return Response::succeeded($successful/*, $failed*/);
    }

    private function handleRawEvent(RawEvent $rawEvent): bool
    {
        try {
            $event = $this->transformer->transform($rawEvent);
            $this->persister->save($event);

            return true;
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }
}
