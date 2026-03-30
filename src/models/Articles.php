<?php
namespace src\models;
use src\serveses\DB;
// namespace src\Views;
class Articles extends ActiveRecordEntity
{
    protected $author_id;
    protected $name;
    protected $text;
    protected $created_at;

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
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setText($text)
    {
        $this->text = $text;
    }
    public function setAuthor_id($author_id)
    {
        $this->author_id = $author_id;
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
    public function getAuthor(): User
    {
        return User::getById($this->author_id);
    }
    public  function updateFromArray(array $field)
    {
        // var_dump($field);
        $this->name = $field['name'];
        $this->text = $field['text'];
        $this->save();
    }

}