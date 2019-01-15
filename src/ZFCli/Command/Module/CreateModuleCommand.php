<?php

namespace ZFCli\Command\Module;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use ZFCli\Source\CreateAction;
use ZFCli\Source\CreateController;
use ZFCli\Source\CreateModule;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>>
 */
class CreateModuleCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('module:create')
            ->setDescription('Create new module')
            ->setHelp('module:help')
            ->addUsage('module:create ModuleName --controller=ControllerName --action=methodName (without "Action"')
            ->addOption(
                '--module',
                '-m',
                InputOption::VALUE_REQUIRED,
                'Type it --module=ModuleName to create inside project'
            )
            ->addOption(
                '--controller',
                '-c',
                InputOption::VALUE_OPTIONAL,
                'This options is OPTIONAL'
            )
            ->addOption(
                '--action',
                '-a',
                InputOption::VALUE_OPTIONAL,
                'This options is OPTIONAL'
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
        $io->section("Checking module \"{$module}\" ...");

        try {
            (new CreateModule(
                $module,
                $controller,
                $action
            ))->generate();

            if ($controller) {
                (new CreateController(
                    getcwd() . '/module',
                    $module,
                    $controller
                ))->generate();
            }

            if ($action) {
                (new CreateAction(
                    getcwd() . '/module',
                    $module,
                    $controller,
                    $action
                ))->generate();
            }

            $io->section("Creating module \"{$module}\"");
            $io->success('Your module created successfully !');
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }
    }
}
