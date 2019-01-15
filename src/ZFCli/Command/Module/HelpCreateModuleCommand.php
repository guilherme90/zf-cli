<?php

namespace ZFCli\Command\Module;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class HelpCreateModuleCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('module:help')
            ->setHelp('module:help');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('<info>MODULE:HELP</info>');
        $io->text('How usage:');
        $io->text('- module:create --module=ModuleName --controller=ControllerName --action=actionName');
        $io->text('- module:create -m ModuleName -c ControllerName -a actionName');

        $io->newLine();
        $io->table([
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