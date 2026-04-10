<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

$controllerName = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'TurmaController';
$action = $parts[1] ?? 'index';

$controllerFile = __DIR__ . '/../app/Controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        http_response_code(404);
        echo "Ação '$action' não encontrada.";
    }
} else {
    http_response_code(404);
    echo "Controller '$controllerName' não encontrado.";
}