<main class="main">
   
            <?php
            renderTitle(
                'Registrar Ponto',
                'Mantenha seu Ponto Consistente',
                'icofont-check-alt'
            );
            echo showSessionMessage();
            cleanSessionMessage();
            ?>
         
    <div class="card">
        <div class="card-header">
            <h3><?=$today?></h3>
            <p class= "mb-0">Os batimentos efetuados hoje</p>
        </div>
        
        <div class="card-body">
            <div class="d-flex justify-content-around m-5">
                <span>Entrada 1: <?= $register->time1  ?? ' ---' ?></span>
                <span>Saída 1: <?= $register->time2 ??  ' ---'?></span>
            </div>
            <div class="d-flex justify-content-around m-5">
            <span>Entrada 2: <?= $register->time3 ??  ' ---' ?></span>
            <span>Saída 2: <?= $register->time4 ?? ' ---' ?></span>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="innout.php?register=<?=$register->work_date?>&user_id=<?=$register->user_id?>" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </a>
        </div>
        

    </div>

    <form action="innout.php" method="post" class="mt-3">
        <div class="input-group no-border">
            <input type="text" class="form-control" name="simulated_time" id="simulated_time">
            <button class="btn btn-danger  ml-3">Simular Ponto</button>
        </div>
    </form>
    <?php
        echo '<pre>';
        print_r($register);
        echo '</pre>';
    ?>


</main>