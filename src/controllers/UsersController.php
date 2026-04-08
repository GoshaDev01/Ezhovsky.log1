<?php
namespace src\controllers;

use src\exceptions\InvalidArgumentException;
use src\models\User;
use src\models\UserAuthService;

class UsersController extends Controller
{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
                // После регистрации сразу логиним пользователя
                UserAuthService::createToken($user);
                header('Location: ../articles/');
                exit;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
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
                // createToken сам сгенерирует новый токен и установит cookie
                UserAuthService::createToken($user);
                header('Location: ../articles/');
                exit;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/logIn.php', ['error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('users/logIn.php');
    }

    public function logOut()
    {
        // Получаем текущего пользователя
        $user = UserAuthService::getUserByToken();
        if ($user !== null) {
            // Очищаем токен в БД
            $user->refreshAuthToken(); // генерируем новый (делаем старый недействительным)
            $user->save();
        }
        // Удаляем cookie
        UserAuthService::deleteToken();
        
        // Перенаправляем на главную
        header('Location: ../articles/');
        exit;
    }

    public function allUsers()
{
    $users = User::findAll();
    $currentUser = UserAuthService::getUserByToken(); // текущий авторизованный пользователь
    $this->view->setVar('currentUser', $currentUser); // передаём отдельно
    $this->view->renderHtml('users/all.php', ['users' => $users]);
}
}