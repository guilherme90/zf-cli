<?php

namespace ZFCli\Command\Controller;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use ZFCli\Source\CreateAction;
use ZFCli\Source\CreateController;

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
            ->addUsage('--module=ModuleName --controller=ControllerName --action=methodName')
            ->addOption(
                '--controller',
                '-c',
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
        $module = $input->getOption('module') ?: null;
        $controller = $input->getOption('controller') ?: null;
        $action = $input->getOption('action') ?: null;

        $io = new SymfonyStyle($input, $output);
        $io->section("Checking controller \"{$controller}\" ...");

        try {
            (new CreateController(
                getcwd() . '/module',
                $module,
                $controller,
                $action
            ))->generate();

            $io->section("Controller: \"{$controller}\" | Action: {$action} | Module: {$module}");
            $io->success('Your controller created successfully !');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }
    }
}