<?php

namespace ZFCli\Command\Controller;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class HelpCreateControllerCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('controller:help')
            ->setHelp('controller:help');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('<info>CONTROLLER:HELP</info>');
        $io->text('How usage:');
        $io->text('- controller:create --module=ModuleName --controller=ControllerName');
        $io->text('- controller:create -m ModuleName -c ControllerName');

        $io->newLine();
        $io->table(
            [
                'Options',
                'Description',
                'REQUIRED'
            ], [
            ['--module, -m', 'Create new Module', 'YES'],
            ['--controller, -c', 'Create new Controller', 'YES'],
            ['--action, -a', 'Create new Action in controller (without "Action")', 'NO'],
        ]);
    }
}