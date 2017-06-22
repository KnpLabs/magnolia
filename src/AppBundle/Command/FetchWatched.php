<?php

namespace AppBundle\Command;

use AppBundle\Github;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchWatched extends Command
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
            ->setName('github:fetch:watched')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $watched = $this->githubClient->getWatched();

        die(dump($watched));
    }
}
