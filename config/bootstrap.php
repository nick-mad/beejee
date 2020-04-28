<?php

use DI\ContainerBuilder;
use \League\Plates\Engine;

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => DB_SERVER,
    'database' => DB_NAME,
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'charset'   => 'utf8',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(
    [
        Engine::class => function () {
            $templates = new Engine();
            $templates->addFolder('site', __DIR__ . '/../templates');
            return $templates;
        }
    ]
);
$containerBuilder->addDefinitions();
return $containerBuilder->build();