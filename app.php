#!/usr/bin/env php
<?php
// app/console

use Cekurte\Avro\Generator\Command\Generator;
use Composer\Autoload\ClassLoader;
use Symfony\Component\Console\Application;

/**
 * @var $loader ClassLoader
 */
$loader = require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$application = new Application();
$application->add(new Generator);
$application->run();
