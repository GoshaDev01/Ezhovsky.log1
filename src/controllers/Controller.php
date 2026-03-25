<?php

namespace Src\Controllers;
use src\views\View;
use src\serveses\DB;

class Controller
{
    public $view;
    public $layout = 'default';

    public function __construct()
    {
        $this->view = new View($this->layout);
    }

    public function main()
    {
        $db = new DB;
        $articles = $db->query("SELECT * FROM `articles`;");
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }
}