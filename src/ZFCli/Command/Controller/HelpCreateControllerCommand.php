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
        $io->title('<info>MODULE:HELP</info>');
        $io->text('How usage:');
        $io->text('controller:create --controller=ControllerName --module=ModuleName --action=actionName (without "Action"');

        $io->newLine();
        $io->table(
            [
                'Options',
                'Alias',
                'Description',
                'REQUIRED'
            ], [
            ['--controller', '-c', 'Create new Controller in module', 'YES'],
            ['--module', '-m', 'Create new module', 'YES'],
            ['--action', '-a', 'Create new Action in controller', 'NO'],
        ]);
    }
}