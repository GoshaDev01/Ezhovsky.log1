<?php

namespace Src\Views;

class View
{
    private $layout;
    private $extraVars =[];

    public function __construct(string $layout)
    {
        $this->layout = $layout;
    }

    public function setVar(string $name, $value)
    { 
        $this->extraVars[$name] = $value;
    }

    public function renderHtml(string $viewName, array $vars = [], int $code = 200)
    {
        http_response_code($code);
        $layoutFile = "layouts/{$this->layout}.php";
        $content = $this->renderFile($viewName, $vars);
        $fileVars = ['content' => $content];
        echo $this->renderFile($layoutFile, $fileVars);
    }

    public function renderFile(string $fileName, array $vars)
{
    extract($vars);
    extract($this->extraVars);
    $fileName = __DIR__ . '/' . $fileName;
    if (file_exists($fileName)) {
        ob_start();
        include $fileName;
        return ob_get_clean(); // исправлено: сразу возвращаем содержимое
    } else {
        echo "Не найден файл по пути $fileName";
        die;
    }
}
}