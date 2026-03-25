<?php
namespace src\models;
use src\serveses\DB;
// namespace src\Views;
class Articles extends ActiveRecordEntity
{
    private $author_id;
    private $name;
    private $text;
    private $created_at;

    // protected static function getTableName(): string
    // {
    //     return 'articles';
    // }
    
    public function getAuthor_id(): int 
    {
        return $this->author_id;
    }
    public function getName(): string 
    {
        return $this->name;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getCreated_at(): int 
    {
        return $this->created_at;
    }
    public static function getById($id): ? self
    {
        $db = DB:: getInstance();;
        $entities = $db->query("SELECT * FROM `articles` WHERE id = :id; ;", [':id' => $id], static::class);   
        return $entities ? $entities[0] : null;
    }
    protected static function getTableName(): string
    {
        return 'articles';
    }
    public function getAuthor(): Users
    {
        return Users::getById($this->author_id);
    }
    

}