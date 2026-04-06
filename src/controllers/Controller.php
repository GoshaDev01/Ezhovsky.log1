<?php

namespace src\Controllers;
use src\views\View;
use src\serveses\DB;
use src\models\UserAuthService;

class Controller
{
    public $view;
    protected $user;
    public $layout = 'default';

    public function __construct()
    {
        // Получаем пользователя из токена
        $this->user = UserAuthService::getUserByToken();
        
        // Инициализируем View с layout
        $this->view = new View($this->layout);
        
        // Передаём пользователя во все шаблоны
        $this->view->setVar('user', $this->user);
    }


    public function main()
    {
        $db = new DB;
        $articles = $db->query("SELECT * FROM `articles`;");
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }
}