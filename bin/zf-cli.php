#!/usr/bin/env php
<?php

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */

require_once getcwd() . '/vendor/autoload.php';

use \ZFCli\Command;

$app = new \Symfony\Component\Console\Application();

// Instructions
$app->add(new Command\InstructionsCommand);

// Modules
$app->add(new Command\Module\CreateModuleCommand('module:create'));
$app->add(new Command\Module\HelpCreateModuleCommand('module:help'));

// Controllers
$app->add(new Command\Controller\HelpCreateControllerCommand('controller:help'));
$app->add(new Command\Controller\CreateControllerCommand('controller:create'));

// Actions
$app->add(new Command\Action\CreateActionCommand('action:create'));
$app->add(new Command\Action\HelpCreateActionCommand('action:help'));

// Routes
$app->add(new Command\Action\HelpRoutesListCommand('route:help'));

$app->run();



