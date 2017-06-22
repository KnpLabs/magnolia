<?php

namespace AppBundle\Github;

use Github\Client as GithubAPI;

class Client
{
    private $client;

    public function __construct(string $githubLogin, string $githubPassword)
    {
        $this->client = new GithubAPI();
        $this->client->authenticate(
            $githubLogin,
            $githubPassword,
            GithubAPI::AUTH_HTTP_PASSWORD
        );
    }

    public function getNotifications()
    {
        return $this
            ->client
            ->api('notification')
            ->all()
        ;
    }

    public function getWatched()
    {
        return $this
            ->client
            ->api('current_user')
            ->watchers()
            ->all()
        ;
    }
}
