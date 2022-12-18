<?php

class Model{
    protected static $tableName;
    protected static array $columns;
    protected array $values;

    public function __construct(array $arr){
        $this->loadFromArray($arr);
    }

    public function loadFromArray(array $arr){
        //$this->values = $arr; -> não é viável porque limparia o array!!!
        foreach ($arr as $key => $value) {
            $this->$key = $value;
        }
    }

    public function save(){
        $tableName = static::$tableName;
        $id = (int)static::getOne(['id'], 'max(id) as id')->id+1; // oi eu aqui gerando um id+1;
              
        $sql = "INSERT INTO " . static::$tableName . "(". 
        implode(', ',static::$columns) . ") values(";
        $sql.= $id .', '; // oi eu aqui metendo o id na query;
        foreach ($this->values as $value) {
            $sql.= static::getFormatedeValue($value) . ", ";
        }
        
        
        $sql = substr_replace($sql, ');', -2);
        
    
       
        // echo "Teste: ".$sql."<br>";
        (new Database)->executeSQL($sql);
    }

    public function delete(){
        $sql = "DELETE FROM " . static::$tableName;

        if(isset($this->values)){
            $sql.= ' WHERE ';
            foreach ($this->values as $key => $value) {
               $sql.= "{$key} = ". static::getFormatedeValue($value);
               if($key != array_key_last($this->values)) $sql.= " AND ";
            }
            
        }
        // echo $sql;
        // (new Database)->executeSQL($sql) ;
        (new Database)->executeSQL($sql);


    }

    public static function getFormatedeValue($val){
        // if(gettype($val)=='integer'){
        //     return $val;
        // }
        if(gettype($val)=='string'){
            return "'" . $val . "'";
        }else{
            return $val;
        }
    }

    public function __set($name, $value){
        $this->values[$name] = $value;
    }

    public function __get($name){
        return $this->values[$name];

    }

    public static function getResultSetFromSelect(array $filters = [], string $columns = '*'){
        $sql = "SELECT ${columns} FROM " . static::$tableName;

        
        $con= new Database();
        return $con->getResultFromQuery($sql, $filters);
            
        
    }

    public static function get(array $filters=[], string $columns = '*'){
        $result = static::getResultSetFromSelect($filters, $columns);
        $class = get_called_class();
        $arrClasses = [];

        if($result){
            foreach($result as $value){
                $arrClasses[] = new $class($value);
            }
        }
        return $arrClasses;
    }

    public static function getOne(array $filters=[], string $columns = '*'){
        if(empty($filters)) return NULL;
        $result = static::getResultSetFromSelect($filters, $columns);
        $class = get_called_class();
        
        $result = $result->fetch();
        return $result? new $class($result):null;

        
    }

}