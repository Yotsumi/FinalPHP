<?php

use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use SimpleMVC\Helper;
use PDO;

$pdoConfig = require 'userPdo.php';

return [
    'view_path' => 'src/View',
    Engine::class => function(ContainerInterface $c) {
        return new Engine($c->get('view_path'));
    },
    'public_db_manager' => function () use ($pdoConfig){
        return new Helper\Test(new PDO($pdoConfig['public']['dsn'], $pdoConfig['public']['user'], $pdoConfig['public']['password']));
    }
];
