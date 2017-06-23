<?php

declare(strict_types=1);

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use UseCases\FetchFeeds as UseCase;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchFeeds extends Command
{
    /** @var UseCase\UseCase */
    private $useCase;

    public function __construct(UseCase\UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    protected function configure()
    {
        $this
            ->setName('magnolia:fetch:feeds')
            ->addArgument('userId', InputArgument::REQUIRED)
            ->setDescription('Fetch all feeds for a user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $request = new UseCase\Request($input->getArgument('userId'));
        $response = $this->useCase->__invoke($request);

        if ($response->isSuccessful()) {
            foreach($response->getFeeds() as $feed) {
            }
        }
    }
}
