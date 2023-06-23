<?php

session_start();

require 'vendor/autoload.php';

if(! isset($_SESSION['auth']) && $_SERVER['REQUEST_URI'] !== '/login'){
    header('Location: /login');
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', function(){
        $controller = new App\Controller\Main();
        $controller->run();
        print_r($_SESSION['auth']);
    });
    $r->addRoute(['GET', 'POST'], '/login', function(){
        $controller = new App\Controller\Login();
        $controller->run();
    });
    $r->addRoute(['GET', 'POST'], '/logout', function(){
        $controller = new App\Controller\Login();
        $controller->runLogout();
    });
    # ControllerUsers routes
    if(isset($_SESSION['auth']) && (int)$_SESSION['auth']['privilege'] == 1){
        $r->addRoute('GET', '/users', function(){
            $controller = new App\Controller\Users();
            $controller->run();
            print_r($_SESSION['auth']);
        });
        $r->addRoute(['GET', 'POST'], '/users/add', function(){
            $controller = new App\Controller\Users();
            $controller->runAdd();
        });
    }      
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo 'Роут неееее создан';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo 'Роут есть, а метода нет';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        $handler($vars);
        break;
}
