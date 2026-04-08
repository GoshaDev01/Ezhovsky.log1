<?php
namespace src\controllers;

use src\models\Articles;
use src\exceptions\NotFoundException;
use src\exceptions\UnAuthorizeException;
use src\exceptions\invalidArgumentException;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Articles::findAll();
        $this->view->renderHtml('articles/index.php', ['articles' => $articles]);
    }

    public function view(int $id)
    {
        $article = Articles::getById($id);
        if ($article === null) {
            throw new NotFoundException();
        }
        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }

    public function edit(int $id)
    {
        $article = Articles::getById($id);
        if ($article === null) {
            throw new UnAuthorizeException();
        }
        if ($this->user === null) {
            throw new UnAuthorizeException();
        }
        if (!empty($_POST)) {
            try {
                // ИСПРАВЛЕНО: передаем и POST, и FILES
                $article->updateFromArray($_POST, $_FILES['img'] ?? null);
                header('Location: ../../article/' . $article->getId());
                exit;
            } catch (invalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', [
                    'article' => $article,
                    'error' => $e->getMessage()
                ]);
                return;
            }
        }
        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }






    // public function edit(int $id)
    // {
    //     $article = Articles::getById($id);
    //     if ($article === null) {
    //         throw new NotFoundException();
    //     }

    //     // Проверка прав: только автор может редактировать
    //     if ($this->user === null || $this->user->getId() !== $article->getAuthor_id()) {
    //         throw new UnAuthorizeException();
    //     }

    //     // Обработка POST до рендеринга
    //     if (!empty($_POST)) {
    //         $article->updateFromArray($_POST);
    //         header('Location: ../../article/' . $article->getId());
    //         exit;
    //     }

    //     $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    // }

    public function add()
    {
        if ($this->user === null) {
            throw new UnAuthorizeException();
        }
        if (!empty($_POST)) {
            try {
                $article = Articles::create($_POST, $_FILES['img'], $this->user);
                header('Location: ../articles/');
                // header(`Location: ../article/{$article->getId()}`);
              
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }
        }
         $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $id)
{
    $article = Articles::getById($id);
    if ($article === null) {
        throw new NotFoundException();
    }
    // Проверка прав
    if ($this->user === null || $this->user->getId() !== $article->getAuthor_id()) {
        throw new UnAuthorizeException();
    }
    $article->delete();
    header('Location: ../../articles/');
    exit;
}
public function search()
{
    if(!empty($_GET['q'])){
        $this->view->renderHtml('article/searc');
        return;
    }else{
        $articles = Articles::search($_GET['q']);
        $this->view->renderHtml('article/searc',['articles'=> $articles]);
    }
}
}