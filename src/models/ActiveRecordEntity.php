<?php

namespace src\models;
use src\serveses\DB;
abstract class ActiveRecordEntity
{
    protected $id;

    public function getId(): int 
    {
        return $this->id;
    }
    public static function findAll(): array
    {
        $db = DB:: getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() .'`;' , [], static::class);
    }
    abstract protected static function getTableName(): string;
    
  
}