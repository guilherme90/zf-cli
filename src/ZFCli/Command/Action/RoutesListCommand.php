<?php

namespace ZFCli\Command\Action;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use ZFCli\Source\RouteList;

/**
 * @author Guilherme Nogueira <guilhermenogueira@gmail.com>
 */
class RoutesListCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('route:list')
            ->setDescription('List of your app routes')
            ->setHelp('module:help')
            ->addOption(
                '--module',
                '-m',
                InputOption::VALUE_OPTIONAL,
                ''
            );
    }

    /**
     * @inheritdoc
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $module = $input->getOption('module') ?: null;

        $io = new SymfonyStyle($input, $output);

        $routeList = new RouteList();

        if ($module) {
            $this->listRoutesFromModule($module, $routeList, $io);

            return;
        }

        $this->listRoutesFromAllModules($routeList, $io);

        return;
    }

    /**
     * @param RouteList $routeList
     * @param SymfonyStyle $io
     * @throws \Exception
     */
    public function listRoutesFromAllModules(RouteList $routeList, SymfonyStyle $io)
    {
        $modules = $routeList->listRoutes(getcwd() . "/module");

        if (count($modules) > 0) {
            $headers = ['Route', 'Type', 'Controller', 'Action'];

            foreach ($modules as $module) {
                $io->newLine();
                $io->section('MODULE: ' . $module['module']);

                $io->table($headers, $module['routes']);
            }

            return;
        }

        $io->text('No modules found');

        return;
    }

    /**
     * @param $module
     * @param RouteList $routeList
     * @param SymfonyStyle $io
     * @throws \Exception
     */
    private function listRoutesFromModule($module, RouteList $routeList, SymfonyStyle $io)
    {
        $routes = $routeList->listRoutesFromModule(getcwd() . "/module/{$module}");

        $io->newLine();
        $io->section('MODULE: ' . $module);

        $headers = ['Route', 'Type', 'Controller', 'Action'];

        $io->table($headers, $routes);
    }
}