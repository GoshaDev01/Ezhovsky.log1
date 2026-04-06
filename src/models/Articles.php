<?php
namespace src\models;
use src\exceptions\invalidArgumentException;
use src\serveses\DB;
// namespace src\Views;
class Articles extends ActiveRecordEntity
{
    protected $author_id;
    protected $name;
    protected $text;
    protected $created_at;
    protected $img = null;

    public function getImg(){
        return $this->img;
    }

    public static function create(array $fields, array $imgFile, User $user): Articles
    {
        if (empty($fields['name'])) {
            throw new invalidArgumentException('Не передано название стаьи');
        }
        if (empty($fields['text'])) {
            throw new invalidArgumentException('Не передан некст стаьи');
        }
        if ($imgFile['size'] > 10 * 1024 * 1024 * 1024) {
            throw new invalidArgumentException('Файл не соответствует допустимым размерам');
        }
        $article = new Articles();
        $article->name = $fields['name'];
        $article->text = $fields['text'];
        $article->author_id = $user->getId();
        if(!empty($imgFile['name'])) {
            $filePath = 'assets/imgs/' . $imgFile['name'];
            $article->img = $filePath;
            if (!move_uploaded_file($imgFile['tmp_name'], $filePath)) {
                throw new invalidArgumentException('ошибка загрузки файла');
            }
        }
        $article->save();
        return $article;
       
    }
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
    // В User.php
    public static function getById($id): ?self
    {
        $db = DB::getInstance();
        $entities = $db->query("SELECT * FROM `" . static::getTableName() . "` WHERE id = :id", [':id' => $id], static::class);
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
    public function updateFromArray(array $field)
    {
        // var_dump($field);
        $this->name = $field['name'];
        $this->text = $field['text'];
        $this->save();
    }

}