<?php
class Login extends Model{

    public function checkLogin(){
        // Testa o email e a senha no atributo values comparandos  com o do banco de dados. Se o retorno for positivo envia um User completo com todas as características senhão lança uma exceção;
        
        $user = User::getOne(['email'=>$this->email]);
               
        if($user){
            if($user->end_date){
                throw new Exception("Usuário desligado da empresa!");
            }
            if (password_verify($this->password, $user->password)) return $user;
        }
        throw new Exception("Usuário ou senha inválidos");
      

    }

    public static function requireValideSession(){
        session_start();
        $user = $_SESSION['user'];
        if(!$user){
            header('Location: login.php');
            exit();
        }
        return $user->name;
    }

    public static function logout(){
        session_start();
        session_destroy();
        header('location: login.php');
    } 
}