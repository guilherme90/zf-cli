<?php

namespace ZFCli\Command\Action;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Guilherme Nogueira <guilhermenogueira2univicosa.com.br>
 */
class HelpCreateActionCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('action:help')
            ->setHelp('action:help');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('<info>ACTION:HELP</info>');
        $io->text('How usage:');
        $io->text('- action:create --module=ModuleName --controller=ControllerName --action=actionName');
        $io->text('- action:create -m ModuleName -c ControllerName -a actionName');

        $io->newLine();
        $io->table(
            [
                'Options',
                'Alias',
                'Description',
                'REQUIRED'
            ], [
            ['--module, -m', 'Create new Module', 'YES'],
            ['--controller, -c', 'Create new Controller', 'YES'],
            ['--action, -a', 'Create new Action in controller (without "Action")', 'YES'],
        ]);
    }
}