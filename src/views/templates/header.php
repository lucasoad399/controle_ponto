<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/comum.css">
    <link rel="stylesheet" href="../assets/css/icofont.min.css">
    <link rel="stylesheet" href="../assets/css/template.css">
    <title>Document</title>
</head>
<body class="">
    <header class="header ">
        <div class="text-center logo">
            <span class="icofont-travelling " alt='ícone de pessoa com bagagem'></span>
            <span class="font-weight-light ">IN </span>
            <span class="font-weight-bold "> N' </span>
            <span class="font-weight-light mr-3"> OUT</span>
            <span class="icofont-runner-alt-1" alt="ícone de pessoa correndo"></span>
        </div>
        <div class="menu-toogle ">
            <span class="icofont-navigation-menu" alt="Botão que controla o menu lateral"></span>
        </div>
        <div class="spacer"></div>
        <div class="dropdown text-white">
            <div class="dropdown-button">
                <span> Usuário <?=$user->name?></span>
                
                <i class="icofont-simple-down"></i>
            </div>
            <div class="dropdown-content bg-white">
                <ul class="nav-list px-4 py-1 m-0 ">
                    <li class="nav-item text-center">
                        <a href="logout.php">
                            Sair
                            <i class="icofont-logout"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </header>    
