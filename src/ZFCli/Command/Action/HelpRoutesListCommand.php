<?php

namespace ZFCli\Command\Action;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class HelpRoutesListCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('route:help')
            ->setHelp('route:help');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('<info>ROUTE:HELP</info>');
        $io->text('How usage:');
        $io->text('- route:list --module=ModuleName');
        $io->text('- route:list -m ModuleName');

        $io->newLine();
        $io->table(
            [
                'Options',
                'Description',
                'REQUIRED'
            ], [
            ['--module, -m', 'List all routes from module', 'NO']
        ]);
    }
}