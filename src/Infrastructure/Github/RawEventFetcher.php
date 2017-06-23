<?php

declare(strict_types=1);

namespace Infrastructure\Github;

use Domain;
use Github\Client;
use Psr\Http\Message\ResponseInterface;

class RawEventFetcher implements Domain\RawEventFetcher
{
    /** @var Client */
    private $client;

    public function __construct(string $githubLogin, string $githubPassword)
    {
        $this->client = new Client();
        $this->client->authenticate(
            $githubLogin,
            $githubPassword,
            Client::AUTH_HTTP_PASSWORD
        );
    }

    public function fetchEvents(string $owner, string $repository): array
    {
        $events = [];
        $page = 0;

        do {
            $events = array_merge($events, $this->client->repository()->events($owner, $repository, ++$page));
            $response = $this->client->getLastResponse();
        } while ($this->hasNextPage($response));

        return $events;
    }

    private function hasNextPage(ResponseInterface $response): bool
    {
        return $response->hasHeader('Link') && strpos($response->getHeader('Link')[0], 'rel="next",') !== false;
    }
}
