<?php
namespace src\controllers;  // Изменено с Src\Controllers на src\controllers

use src\exceptions\invalidArgumentException;
use src\models\User;

class UsersController extends Controller
{
    public function signUp()
    {
        if(!empty($_POST)){
        try{
        
            $user = User::signUp($_POST);  // Исправлено: Users, а не User
        
    }catch(invalidArgumentException $e){
        $this->view->renderHtml('users/signUp.php', ['error'=> $e->getMessage()]);
        return;
    
    }
    if($user instanceof User)
    {
         $this->view->renderHtml('users/signUp.php');
         return;
    }
}
$this->view->renderHtml('users/signUp.php');
    }
}