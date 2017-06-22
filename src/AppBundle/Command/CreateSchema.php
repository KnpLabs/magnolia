<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Schema\Schema;

class CreateSchema extends Command
{
    private $dbal;

    private $dbName;

    public function __construct(Connection $dbal, string $dbName)
    {
        $this->dbal = $dbal;
        $this->dbName = $dbName;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:create:schema')
            ->setDescription('Create schema.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating schema.');

        $schema = new Schema();
        $feeds = $schema->createTable('feeds');
        $feeds->addColumn('id', 'string', [
            'length' => 36,
            'notnull' => true,
        ]);
        $feeds->addColumn('userId', 'string', [
            'notnull' => true,
            'length' => 36,
        ]);
        $feeds->setPrimaryKey(["id"]);

        $queries = $schema->toSql($this->dbal->getDatabasePlatform());
        foreach($queries as $query) {
            $this->dbal->executeQuery($query);
        }

        $output->writeln('Schema created.');
    }
}
