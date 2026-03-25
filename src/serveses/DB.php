<?php

namespace Src\Serveses;

class DB
{
    private $pdo;
    private static $instance;
    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../config/settingsDB.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );

        $this->pdo->exec('SET NAMES UTF8');
    }
    public static function getInstance() //статик выполняется просто так, без вызова
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            return null;
        }
    //   var_dump($sth);
        return $sth->fetchAll(\PDO:: FETCH_CLASS, $className);
    }
}
