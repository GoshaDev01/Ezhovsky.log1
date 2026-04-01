<?php
namespace src\controllers;  // Изменено с Src\Controllers на src\controllers

use src\exceptions\invalidArgumentException;
use src\models\User;

class UsersController extends Controller
{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {

                $user = User::signUp($_POST); 

            } catch (invalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;

            }
            if ($user instanceof User) {
                $this->view->renderHtml('users/signUp.php');
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php');
    }
    public function logIn()
    {
        if (!empty($_POST)) {
            try {
                $user = User::logIn($_POST);  
                var_dump('login_well'); die();
            } catch (invalidArgumentException $e) {
                $this->view->renderHtml('users/logIn.php', ['error' => $e->getMessage()]);
                return;

            }
        }
        $this->view->renderHtml('users/logIn.php');
                return;
    }

}