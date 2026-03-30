<?php
namespace src\models;
use src\serveses\DB;
use src\exceptions\InvalidArgumentException;
// namespace src\Views;
class User extends ActiveRecordEntity
{
    protected $id;
    protected $nickname;
    protected $email;
    protected $is_confirmed = 0;
    protected $role;
    protected $password_hash;
    protected $auth_token;

    protected $created_at;

  
    
    public function getId(): int 
    {
        return $this->id;
    }
    public function getAuth_token(): int 
    {
        return $this->auth_token;
    }
    public function getNickname(): string 
    {
        return $this->nickname;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getPassword_hash(): string
    {
        return $this->password_hash;
    }
    public function getIs_confirmed(): int 
    {
        return $this->is_confirmed;
    }
    public function getCreated_at(): int 
    {
        return $this->created_at;
    }
    public static function getById($id): ? self
    {
        $db = DB::getInstance();;
        $entities = $db->query("SELECT * FROM `users` WHERE id = :id; ;", [':id' => $id], static::class);   
        return $entities ? $entities[0] : null;
    }
    protected static function getTableName(): string
    {
        return 'users';
    }
    public static function signUp(array $userData)
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан логин');
        }
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан адрес эл. почты');
        }
        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'], )) {
            throw new InvalidArgumentException('Логин должен содержать только символы латинсого алфавита и цифры');
        }
        if (mb_strlen($userData['nickname']) <= 8) {
            throw new InvalidArgumentException('Пароль должен состоять из не меннее 8 символов');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Не корректны адрес эл. почты');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Не корректны адрес эл. почты');
        }
        if (static::findOneByColumn('nickname', $userData['nickname']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким логином уже существует');
        }
        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->password = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->is_confirmed = true;
        $user->role = 'user';
        $user->auth_tocken = sha1(random_bytes(100)) . sha1(random_bytes(100)) . sha1(random_bytes(100));

        $user->save();
        return $user;
    }

}