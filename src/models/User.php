<?php

class User extends Model{

    protected static $tableName = 'users';
    protected static array $columns = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin'
    ];

    public static function getActiveUsersCount(){
        $conn = new Database;
        $conn->getConnection();
        $result = $conn->getResultFromQuery("
        SELECT count(*) as count FROM ". SELF::$tableName. " WHERE end_date is NULL
        ",[]);;
        return $result->fetchAll()[0]['count'];
    }
    
}