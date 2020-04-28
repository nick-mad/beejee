<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/defined.php';
$container = require __DIR__ . '/../config/bootstrap.php';

session_start();

use FastRoute\RouteCollector;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->get('/', ['App\Controllers\TaskController', 'showTasks']);
    $r->addRoute(['GET', 'POST'], '/add', ['App\Controllers\TaskController', 'addTasks']);
    $r->addRoute(['GET', 'POST'], '/edit/{id:\d+}', ['App\Controllers\TaskController', 'editTasks']);

    $r->addRoute('GET', '/login', ['\App\Controllers\LoginController', 'loginForm']);
    $r->addRoute('POST', '/login', ['\App\Controllers\LoginController', 'login']);
    $r->addRoute('GET', '/logout', ['\App\Controllers\LoginController', 'logout']);
}, [
    'cacheFile' => __DIR__ . '/route.cache',
    'cacheDisabled' => false,
]);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $uri);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header('HTTP/1.1 404 Not Found');
        $container->call(array('\App\Controllers\notFound', 'index'));
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];
        $container->call($controller, $parameters);
        break;
}
