#!/usr/bin/env php
<?php

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */

require_once getcwd() . '/vendor/autoload.php';

use \ZFCli\Command;

$app = new \Symfony\Component\Console\Application();
$app->add(new Command\InstructionsCommand);
$app->add(new Command\Module\CreateModuleCommand('module:create'));
$app->add(new Command\Module\HelpCreateModuleCommand('module:help'));

$app->add(new Command\Controller\HelpCreateControllerCommand('controller:help'));
$app->add(new Command\Controller\CreateControllerCommand('controller:create'));

$app->run();



