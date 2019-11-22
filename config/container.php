<?php

use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use SimpleMVC\Helper;

$pdoConfig = require 'userPdo.php';

return [
    'view_path' => 'src/View',

    Engine::class => function(ContainerInterface $c) {
        return new Engine($c->get('view_path'));
    },

    'public_db_manager' => function () use ($pdoConfig){
        return new Helper\Test(new PDO(         // Cambiare Helper\Test e inserire il namespace\classname della classe pdo
            $pdoConfig['public']['dsn'], 
            $pdoConfig['public']['user'], 
            $pdoConfig['public']['password']
        ));
    },

    'admin_db_manager' => function () use ($pdoConfig){
        return new Helper\Test(new PDO(         // Cambiare Helper\Test e inserire il namespace\classname della classe pdo
            $pdoConfig['admin']['dsn'], 
            $pdoConfig['admin']['user'], 
            $pdoConfig['admin']['password']
        ));
    }

];
