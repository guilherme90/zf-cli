<?php

namespace ZFCli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */
class InstructionsCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('list')
            ->setDescription('Commands list')
            ->setHelp('Display all available commands');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('<info>Welcome to Zend Framework CLI</info>');
        $io->text('See as available options');

        $io->newLine();
        $io->table(
            [
                'Commands',
                'Description'
            ], [
                ['module:create', 'Create new module'],
                ['module:help', 'Display help from command'],
                new TableSeparator(),
                ['controller:create', 'Create new Controller'],
                ['controller:help', 'Display help from command']
            ]);
    }
}
