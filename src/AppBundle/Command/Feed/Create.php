<?php

declare(strict_types=1);

namespace AppBundle\Command\Feeds;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UseCases\CreateFeed as UseCase;

class Create extends Command
{
    /** @var UseCase\UseCase */
    private $useCase;

    /** @var string */
    private $userId;

    public function __construct(UseCase\UseCase $useCase, string $userId)
    {
        parent::__construct();

        $this->useCase = $useCase;
        $this->userId = $userId;
    }

    protected function configure()
    {
        $this
            ->setName('magnolia:feed:create')
            ->addArgument('name', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $request = new UseCase\Request(
            $input->getArgument('name'),
            $this->userId
        );

        $response = $this->useCase->__invoke($request);

        if ($response->isFailed()) {
            $io->error(
                array_merge(['Unable to create feed.'], $response->getErrors())
            );
            return;
        }

        $io->success(sprintf(
            'Feed "%s" (id: %s) successfully created.',
            $input->getArgument('name'),
            $response->getFeedId()
        ));
    }
}
