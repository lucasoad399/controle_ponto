<?php
class Database
{
    public function getConnection(){
        $env = parse_ini_file(realpath(__DIR__) . '/../env.ini');

        try {
            $con = new PDO(
                "mysql:host={$env['host']};
                dbname={$env['database']}", 
                $env['username'], $env['password'],
                array(
                    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC    
                )
            );
            return $con;
        } catch (PDOException $e) {
            die( 
                "<p style='color:red; font-weight:bold;'>
                    Problemas de conexão: {$e->getMessage()}
                </p>"
            );
        }

        
    }

    public function getFormatedQuery($query){
        $querytype = gettype($query);
        if($querytype=='integer'){
            return PDO::PARAM_INT;
        }
        if($querytype == 'NULL'){
            return PDO::PARAM_NULL;
        }
        if($querytype == 'boolean'){
            return PDO::PARAM_BOOL;
        }

        return PDO::PARAM_STR;
    }

    public function preparedResult($sql, $filters){

        $con= $this->getConnection();
            $stmt = $con->prepare($sql);
            foreach($filters as $key=>$value){
                $stmt->bindValue(":$key", $value, $this->getFormatedQuery($value));
    
            }

            
            $stmt->execute();
            return $stmt;
            return $stmt->fetchAll();

    }

    public function getResultFromQuery(string $sql, array $filters){
        
        if(sizeof($filters)){
            $sql .= ' where ';
            foreach($filters as $key=> $value){
                $sql .= "$key = :$key";

                if($key != array_key_last($filters)) $sql.= " AND ";
            }

        }
        // echo $sql;
        return $this->preparedResult($sql,$filters);

    }

    public function executeSQL($sql){
        $conn = $this->getConnection($sql);
        // echo $sql . '<br>';
        // if(!$conn->exec($sql)){
        //     throw new Exception("Sei lá que porra Rolou, mas o dado não foi persistido no banco: $sql");
            
        // }
        try {
            $conn->exec($sql);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        // $id= $conn->lastInsertId();
        // return $id;
        return true;
    }
    
}
