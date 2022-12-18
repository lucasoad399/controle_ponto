<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/comum.css">
    <link rel="stylesheet" href="../assets/css/icofont.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Document</title>
</head>
<body class="d-flex justify-content-center align-items-center">

    <form  action="#" method="post" class="d-flex justify-content-center align-items-center align-self-center form-center">
        <div class="card border " >
            <div class="card-header d-flex justify-content-center justify-content-between">
                <span class="icofont-travelling " alt='ícone de pessoa com bagagem'></span>
                
                <div class="form-title">
                    <span class="font-weight-bold">IN </span>
                    <span> N' </span>
                    <span class="font-weight-bold"> OUT</span>
                </div>

                <span class="icofont-runner-alt-1" alt="ícone de pessoa correndo"></span>
            </div>
            <div class="card-body form-group pb-0">
                <?php
                    if(isset($exception)){
                ?>
                <div class="alert alert-danger"><?=$exception?></div>
                <?php } ?>
                <div>
                    <label for="email">Email</label>
                    <input class =" form-control"type="email" name="email" id="email" placeholder="Seu email aqui" value="<?= isset($email)?$email:'' ?>">
                </div>

                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Sua senha aqui">
                </div>
                <div class="mt-2 text-center">
                    <button class="btn btn-info ">Entrar</button>
                </div>
            </div>
    </div>

    </form>
 

</body>
</html>