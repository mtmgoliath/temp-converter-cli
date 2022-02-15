#!/usr/bin/env php
<?php
// application.php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\ConvertToCelsiusCommand;
use App\Command\ConvertToFahrenheitCommand;

$application = new Application();

// ... register commands
$application->add(new ConvertToCelsiusCommand());
$application->add(new ConvertToFahrenheitCommand());

$application->run();