<?php
declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use DI\ContainerBuilder;
use SimpleMVC\Controller\Error404;
use Zend\Diactoros\ServerRequestFactory;
use SimpleMVC\Helper\RegexHelper;

$builder = new ContainerBuilder();
$builder->addDefinitions('config/container.php');
$container = $builder->build();

// https://github.com/zendframework/zend-diactoros/blob/master/src/ServerRequest.php
$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// Routing
$path   = $request->getUri()->getPath();
$method = $request->getMethod();
$murl   = sprintf("%s %s", $method, $path);

if (preg_match(RegexHelper::setUrl('article'), $path, $arres)){
    $murl   = sprintf("%s %s", $method, $arres[1]);
}

$routes = require 'config/route.php';
$controllerName = $routes[$murl] ?? Error404::class;

$controller = $container->get($controllerName);
$controller->execute($request);
