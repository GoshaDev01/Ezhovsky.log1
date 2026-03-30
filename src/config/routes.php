<?php
return [
    '~^articles/add$~' => [src\controllers\ArticlesController::class, 'add'],
    '~^articles/$~' => [src\controllers\ArticlesController::class, 'index'],
    '~^article/(\d+)$~' => [src\controllers\ArticlesController::class, 'view'],
    '~^article/(\d+)/edit$~' => [src\controllers\ArticlesController::class, 'edit'],
    '~^article/(\d+)/delete$~' => [src\controllers\ArticlesController::class, 'delete'],
    '~^users/signUp$~' => [src\controllers\UsersController::class, 'signUp'],
    '~^hello/(.*)$~' => [src\controllers\MainController::class, 'sayHello'],
    '~^test/$~' => [src\controllers\TestController::class, 'view'],
    '~^$~' => [src\controllers\MainController::class, 'main'],
];