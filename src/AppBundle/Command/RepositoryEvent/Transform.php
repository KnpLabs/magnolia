<?php

declare(strict_types=1);

namespace AppBundle\Command\RepositoryEvent;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UseCases\TransformRepoEvents as UseCase;
use Symfony\Component\Console\Command\Command;

class Transform extends Command
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
            ->setName('magnolia:repository-event:transform')
            ->addArgument('repository', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $request  = new UseCase\Request($input->getArgument('repository'));
        $response = $this->useCase->__invoke($request);

        if ($response->isSuccessful()) {
            $output->writeln(sprintf('Successfully transformed %d events', $response->getNumberOfTransformedEvents()));
        } else {
            $output->writeln(array_merge(
                ['Error(s) happened while transforming repo events.'],
                $response->getErrors()
            ));
        }
    }
}
