<?php

namespace src\models;

class UserAuthService
{
    // Создание токена и установка cookie
    public static function createToken(User $user)
    {
        // Генерируем новый токен при каждом входе
        $user->refreshAuthToken();
        $user->save();
        $token = $user->getId() . ';' . $user->getAuth_token();
        setcookie('token', $token, time() + 30 * 24 * 60 * 60, '/', '', false, true);        
        // Устанавливаем cookie на весь домен, на 30 дней
        // expires: time() + 30*24*60*60 = 30 дней
        // path: '/' - доступна на всём сайте
        // domain: '' - текущий домен
        // secure: false - для http (если https, поставьте true)
        // httponly: true - защита от XSS
    }
    
    // Получение пользователя по токену из cookie
    public static function getUserByToken(): ?User
    {
        // Проверяем наличие cookie
        if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
            return null;
        }
        
        $token = $_COOKIE['token'];
        
        // Разделяем id и токен
        $parts = explode(';', $token, 2);
        if (count($parts) !== 2) {
            return null;
        }
        
        [$userId, $authToken] = $parts;
        
        // Ищем пользователя в БД
        $user = User::getById((int)$userId);
        if ($user === null) {
            return null;
        }
        
        // Сравниваем токены
        if ($user->getAuth_token() !== $authToken) {
            return null;
        }
        
        return $user;
    }
    
    // Удаление токена (выход)
    public static function deleteToken()
    {
        // Удаляем cookie, устанавливая время в прошлом
        setcookie('token', '', time() - 3600, '/', '', false, true);
    }
}