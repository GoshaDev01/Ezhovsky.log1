<?php

namespace src\Controllers;
use src\views\View;
use src\serveses\DB;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct(); // ВЫЗОВИТЕ РОДИТЕЛЬСКИЙ КОНСТРУКТОР
    }

    public function main()
    {
        $db = DB::getInstance();
        $articles = $db->query("SELECT * FROM `articles`;");
        $this->view->renderHtml('articles/index.php', ['articles' => $articles]);
    }

    public function sayHello($name)
    {
        echo 'Привет, ' . $name;
    }
}