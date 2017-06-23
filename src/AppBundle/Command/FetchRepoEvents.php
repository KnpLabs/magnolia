<?php

declare(strict_types=1);

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UseCases\FetchRepoEvents as UseCase;
use Symfony\Component\Console\Command\Command;

class FetchRepoEvents extends Command
{
    /** @var UseCase\UseCase */
    private $useCase;

    public function __construct(UseCase\UseCase $useCase)
    {
        parent::__construct();

        $this->useCase = $useCase;
    }

    protected function configure()
    {
        $this
            ->setName('magnolia:event:fetch')
            ->addArgument('repository', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $request  = new UseCase\Request($input->getArgument('repository'));
        $response = $this->useCase->__invoke($request);

        if ($response->isSuccessful()) {
            $output->writeln(sprintf('Successfully fetched %d events', $response->getNumberOfFetchedEvents()));
        } else {
            $output->writeln(array_merge(
                ['Error(s) happened while fetching repo events.'],
                $response->getErrors()
            ));
        }
    }
}
