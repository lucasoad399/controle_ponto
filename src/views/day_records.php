<main class="main">
   
            <?php
            renderTitle(
                'Registrar Ponto',
                'Mantenha seu Ponto Consistente',
                'icofont-check-alt'
            );
            
            ?>
         
    <div class="card">
        <div class="card-header">
            <h3><?=$today?></h3>
            <p class= "mb-0">Os batimentos efetuados hoje</p>
        </div>
        <?php
    

        ?>
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
            <a href="???" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </a>
        </div>

    </div>


</main>