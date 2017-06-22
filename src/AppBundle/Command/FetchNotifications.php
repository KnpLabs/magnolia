<?php

namespace AppBundle\Command;

use AppBundle\Github;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchNotifications extends Command
{
    private $githubClient;

    public function __construct(Github\Client $githubClient)
    {
        $this->githubClient = $githubClient;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('github:fetch:notifications')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $notifications = $this->githubClient->getNotifications();

        die(dump($notifications));
    }
}
