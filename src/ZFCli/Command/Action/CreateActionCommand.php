<?php

namespace ZFCli\Command\Action;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use ZFCli\Source\CreateAction;

/**
 * @author Guilherme Nogueira <guilhermenogueira2univicosa.com.br>
 */
class CreateActionCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('action:create')
            ->setDescription('Create new action')
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
                InputOption::VALUE_REQUIRED,
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
            (new CreateAction(
                getcwd() . '/module',
                $module,
                $controller,
                $action
            ))->generateNewActionMethod();

            $io->section("Action: \"{$action}\" | Controller: {$controller} | Module: {$module}");
            $io->success('Your controller created successfully !');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }
    }
}