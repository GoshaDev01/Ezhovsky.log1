<?php

namespace src\models;
use LDAP\Result;
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
    public function getRelectorProperties()
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $resultProperties = [];
        foreach($properties as $property){
            $propertyName = $property->getName();
            $resultProperties[$propertyName] = $this->$propertyName;
        }
        return $resultProperties;
    }
    public function save()
    {
        $properties = $this->getRelectorProperties();
        if($this->id !==null){
            $this->update($properties);
        } else {
            $this->insert($properties);
        }
    }

    public function update($properties)
    {
        $colums2params = [];
        $colums2values = [];
        $index = 1;
        foreach($properties as $column => $value){
            $param = ':param'.$index;
            $colums2params[] = $column . ' = ' . $param;
            $colums2values[$param] = $value;
            $index++;
        }
        $sql = 'UPDATE ' . static:: getTableName() . ' SET ' . implode(', ', $colums2params) . ' WHERE id = ' .$this->id;
        var_dump($sql);
        $db= DB:: getInstance();
        $db->query($sql, $colums2values, static::class);
    }
    public function insert($properties)
    {
        $filteredProperties = array_filter($properties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach($filteredProperties as $columnName=>$value){
            $columns[] = '`' . $columnName . '`';
            $paramsName = ':' . $columnName;
            $paramsNames[] = $paramsName;
            $params2values[$paramsName] = $value;

         }
         $sql = 'INSERT INTO ' . static::getTableName() . ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $paramsNames) . ');';
         $db= DB:: getInstance();
         $db->query($sql, $params2values, static::class);
         $this->id = $db->getLastInsertId();
        //  var_dump(($sql));
        
    }
    public function delete()
    {
        $db=DB::getInstance(); // опдключение к бд
        $db->query('DELETE FROM `' . static::getTableName() . '` WHERE id = :id',[':id'=>$this->id], );
        $this->id = null;
    }
    abstract protected static function getTableName(): string;

    
    
  
}