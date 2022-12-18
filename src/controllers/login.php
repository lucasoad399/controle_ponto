<?php
    session_start();
    if(isset($_POST) AND count($_POST)>0){
        $login = new Login($_POST);
        try {
            $user = $login->checkLogin();
            $_SESSION['user'] = $user;
            echo 'Usuário logado';
            header('location: day_records.php');

            echo '<pre>';
            print_r($user);
            echo '</pre>';
        } catch (\Exception $e) {
            
            // echo 'Somethem wrong...' . $e->getMessage();
            sisLoad('view', 'login', array_merge($_POST, ['exception'=>$e->getMessage()]));
        }

    }else{
        sisLoad('view', 'login', $_POST);
    }
