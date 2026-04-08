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
            // ИСПРАВЛЕНО: создаем полный путь на сервере
            $uploadDir = __DIR__ . '/../../assets/imgs/';
            
            // Создаем папку, если её нет
            // if (!is_dir($uploadDir)) {
            //     mkdir($uploadDir, 0777, true);
            // }
            
            // Генерируем уникальное имя, чтобы избежать конфликтов
            $ext = pathinfo($imgFile['name'], PATHINFO_EXTENSION);
            $uniqueName = uniqid() . '.' . $ext;
            $filePath = $uploadDir . $uniqueName;
            
            $article->img = '/assets/imgs/' . $uniqueName; // относительный путь для браузера
            
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
    public function updateFromArray(array $fields, array $imgFile = null): Articles
    {
        if (empty($fields['name'])) {
            throw new invalidArgumentException('Не передано название статьи');
        }
        if (empty($fields['text'])) {
            throw new invalidArgumentException('Не передан текст статьи');
        }
        
        $this->name = $fields['name'];
        $this->text = $fields['text'];
     
        if($imgFile && !empty($imgFile['name']) && $imgFile['error'] === UPLOAD_ERR_OK) {
            // Проверка размера файла (10MB = 10 * 1024 * 1024)
            if ($imgFile['size'] > 10 * 1024 * 1024) {
                throw new invalidArgumentException('Файл не соответствует допустимым размерам (максимум 10MB)');
            }
            
            // Создаем полный путь на сервере
            $uploadDir = __DIR__ . '/../../assets/imgs/';
            
            // СОЗДАЕМ ПАПКУ, если её нет
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Удаляем старое фото, если есть
            if ($this->img && file_exists(__DIR__ . '/../..' . $this->img)) {
                unlink(__DIR__ . '/../..' . $this->img);
            }
            
            // Генерируем уникальное имя, чтобы избежать конфликтов
            $ext = pathinfo($imgFile['name'], PATHINFO_EXTENSION);
            $uniqueName = uniqid() . '.' . $ext;
            $filePath = $uploadDir . $uniqueName;
            
            $this->img = '/assets/imgs/' . $uniqueName; // относительный путь для браузера
            
            if (!move_uploaded_file($imgFile['tmp_name'], $filePath)) {
                throw new invalidArgumentException('Ошибка загрузки файла');
            }
        }
        
        $this->save();
        return $this;
    }

}