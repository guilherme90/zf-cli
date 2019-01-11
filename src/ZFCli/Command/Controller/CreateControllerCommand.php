<?php

namespace ZFCli\Command\Controller;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class CreateControllerCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('controller:create')
            ->setDescription('Create new controller')
            ->setHelp('module:help')
            ->addUsage('--controller=ControllerName --module=ModuleName --action=methodName (without "Action"')
            ->addOption(
                '--controller',
                '-o',
                InputOption::VALUE_REQUIRED,
                ''
            )
            ->addOption(
                '--module',
                '-m',
                InputOption::VALUE_REQUIRED,
                ''
            )
            ->addOption(
                '--action',
                '-a',
                InputOption::VALUE_OPTIONAL,
                ''
            );
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $controller = $input->getOption('controller') ?: null;
        $action = $input->getOption('action') ?: null;

        $io = new SymfonyStyle($input, $output);
        $io->section("Checking controller \"{$controller}\" ...");

    }
}