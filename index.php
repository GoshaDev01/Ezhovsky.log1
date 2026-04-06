<?php
try {
    spl_autoload_register(function (string $className) {
        $path = __DIR__ . '/' . str_replace('\\', '/', $className . '.php');
        if (file_exists($path)) {
            require $path;
        }
    });

    $route = $_GET['route'] ?? '';
    $routes = require_once __DIR__ . '/src/config/routes.php';
    
    $isRouteFound = false;
    $controllerName = null;
    $actionName = null;
    $matches = [];

    foreach ($routes as $pattern => $controllerAndAction) {
        if (preg_match($pattern, $route, $matches)) {
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
    $errorController = new \src\controllers\MainController();
    $errorController->view->renderHtml('errors/500.php', ['error' => $e->getMessage()], 500);
} catch (\src\exceptions\NotFoundException $e) {
    $errorController = new \src\controllers\MainController();
    $errorController->view->renderHtml('errors/404.php', ['error' => $e->getMessage()], 404);
} catch (\src\exceptions\UnAuthorizeException $e) {
    $errorController = new \src\controllers\MainController();
    $errorController->view->renderHtml('errors/401.php', ['error' => $e->getMessage()], 401);
}