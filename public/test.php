<?php

declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->addDefinitions('config/container.php');
$container = $builder->build();

$testVariable = $container->get('public_db_manager');
$testVariable->TEST();