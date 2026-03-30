<?php

namespace Src\Controllers;
use src\models\Articles;
use src\models\Users;
use src\exceptions\NotFoundException;


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
            throw new NotFoundException();
            // $this->view->renderHtml('errors/404.php',[],404);
            // return;
        }
       
    }
    public function edit($id) //редактирование
    {
        $article = Articles::getById($id);
        // var_dump($article);
        if($article === null){
            // $this->view->renderHtml('errors/404.php',[],404);
            // return;
            throw new NotFoundException();
        }
        $this->view->renderHtml('articles/edit.php',['article' => $article]);

        if(!empty($_POST)){
            $article->updateFromArray($_POST);
        }
    }
    public function add()
    {
        $article = new Articles();
        $article->setName('Новая статья');
        $article->setText('Текст новой статья');
        $article->setAuthor_id(1);
        $article->save();
    }
    public function delete($id) //редактирование
    {
        $article = Articles::getById($id);
        // var_dump($article);
        if($article === null){
            throw new NotFoundException();
            // $this->view->renderHtml('errors/404.php',[],404);
            // return;
        }
        $article->delete();
        // $this->view->renderHtml('articles/edit.php',['article' => $article]);

        // if(!empty($_POST)){
        //     $article->updateFromArray($_POST);
        // }
    }
   
}