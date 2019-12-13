<?php

use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use SimpleMVC\Helper\CryptMsg;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Model\UtenteDb;

$pdoConfig = require 'userPdo.php';

return [
    'view_path' => 'src/View',
    
    Engine::class => function(ContainerInterface $c) {
        return new Engine($c->get('view_path'));
    },

    // encrypting & session
    CryptMsg::class => function(ContainerInterface $c) {
        return CryptMsg::instance();
    },

    SessionHandle::class => function(ContainerInterface $c) {
        return SessionHandle::instance($c->get(CryptMsg::class), $c->get(CryptMsg::class)::nonce());
    },

    LoginAction::class => function(ContainerInterface $c) {
        return new LoginAction($c->get(SessionHandle::class), $c->get(UtenteDb::class));
    },

    // table maps
    UtenteDb::class => function (ContainerInterface $c) {
        return new UtenteDb($c->get('admin_db_manager'));
    },

    // db
    'public_db_manager' => function () use ($pdoConfig){
        return new PDO(         // Cambiare Helper\Test e inserire il namespace\classname della classe pdo
            $pdoConfig['public']['dsn'], 
            $pdoConfig['public']['user'], 
            $pdoConfig['public']['password']
        );
    },

    'admin_db_manager' => function () use ($pdoConfig){
        return new PDO(         // Cambiare Helper\Test e inserire il namespace\classname della classe pdo
            $pdoConfig['admin']['dsn'], 
            $pdoConfig['admin']['user'], 
            $pdoConfig['admin']['password']
        );
    }

];
