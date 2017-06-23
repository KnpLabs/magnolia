<?php

declare(strict_types=1);

namespace AppBundle\Command\Feed;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UseCases\ReadFeed as UseCase;

class ReadFeed extends Command
{
    private $useCase;

    public function __construct(UseCase\UseCase $useCase)
    {
        parent::__construct();

        $this->useCase = $useCase;
    }

    protected function configure()
    {
        $this
            ->setName('magnolia:feed:read')
            ->addArgument('feedId', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $request = new UseCase\Request($input->getArgument('feedId'));
        $response = $this->useCase->__invoke($request);

        $io = new SymfonyStyle($input, $output);

        if ($response->isFailed()) {
            $io->error(array_merge(
                ['Balek.'],
                $response->getErrors()
            ));
            return;
        }

        foreach ($response->getEvents() as $event) {
            $io->success(sprintf('%s happened at %s.', $event->getType(), $event->getDate()));
        }
    }
}
