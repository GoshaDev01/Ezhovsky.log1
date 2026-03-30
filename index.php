<?php
try {
    // use Src\Controllers\MainController;  
    spl_autoload_register(function (string $className) {
        require __DIR__ . '/' . str_replace('\\', '/', $className . '.php');
    });

    $route = $_GET['route'] ?? '';
    $routes = require_once __DIR__ . '/src/config/routes.php';
    
    $isRouteFound = false;
    $controllerName = null;
    $actionName = null;
    $matches = [];

    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            $controllerName = $controllerAndAction[0];
            $actionName = $controllerAndAction[1];
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \src\exceptions\NotFoundException();
    }

    unset($matches[0]);
    $controller = new $controllerName;
    $controller->$actionName(...$matches);
    
} catch (\src\exceptions\DbException $e) {
    // Создаем контроллер для отображения ошибки
    $errorController = new \src\Controllers\MainController();
    $errorController->view->renderHtml('errors/500.php', ['error' => $e->getMessage()], 500);
    
} catch (\src\exceptions\NotFoundException $e) {
    // Создаем контроллер для отображения ошибки
    $errorController = new \src\Controllers\MainController();
    $errorController->view->renderHtml('errors/404.php', ['error' => $e->getMessage()], 404);
}
?>