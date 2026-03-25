<?php
namespace src\models;
use src\serveses\DB;
// namespace src\Views;
class Users extends ActiveRecordEntity
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
        $db = DB:: getInstance();;
        $entities = $db->query("SELECT * FROM `users` WHERE id = :id; ;", [':id' => $id], static::class);   
        return $entities ? $entities[0] : null;
    }
    protected static function getTableName(): string
    {
        return 'users';
    }

}