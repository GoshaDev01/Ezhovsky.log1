<?php

namespace Src\Controllers;
use src\models\Articles;
use src\models\Users;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Articles:: findAll();
        // $db = new DB;
        // $articles = $db->query("SELECT * FROM `articles`;" , [], Articles::class);
        // var_dump($articles); die;
        $this->view->renderHtml('articles/index.php', ['articles' => $articles]);
    }

    
    public function view($id)
    {
        $article = Articles::getById($id);
        if($article !== null){

            // $author = Users:: getById($article->getAuthor_id());
            $this->view->renderHtml('articles/view.php', ['article' => $article]);
        }else{
            $this->view->renderHtml('errors/404.php',[],404);
        }
       
    }
    public function edit($id) //редактирование
    {
        $article = Articles::getById($id);
        // var_dump($article);
        if($article === null){
            $this->view->renderHtml('errors/404.php',[],404);
        }
        $this->view->renderHtml('articles/edit.php',['article' => $article]);
    }
   
}