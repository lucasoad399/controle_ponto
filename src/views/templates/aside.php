<aside class="aside">
    <nav class="menu mt-3">
        <ul class=" nav-list list-unstyled">
            <li class="nav-item ">
                <a class="text-decoration-none" href="day_records.php">
                    <i class="icofont-ui-check mr-2"></i>
                    Registrar Ponto
                </a>
            </li>
            <li class="nav-item ">
                <a class="text-decoration-none" href="day_records.php?main=monthly_report">
                    <i class="icofont-ui-calendar mr-2"></i>
                    Relatório Mensal
                </a>
            </li>
            <li class="nav-item ">
                <a class="text-decoration-none" href="day_records.php?main=maneger_report">
                    <i class="icofont-chart-histogram mr-2"></i>
                    Relatório Gerencial
                </a>
            </li>
            <li class="nav-item ">
                <a class="text-decoration-none" href="day_records.php?main=users">
                    <i class="icofont-users mr-2"></i>
                    Usuários
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-widgets">
        <div class="sidebar-widget">
            <i class="icon icofont-hour-glass text-primary"></i>
            <div class="info">
                <span class="main text-primary testexpto <?=$activeClock=='workingHours' ?'active-clock':''?>">
                    <?=$workedTime->format('%H:%I:%S')?>
                   
                </span>
                <span class="label text-muted">Horas Trabalhadas</span>
            </div>
        </div>
        <div class="division my-3"></div>
        <div class="sidebar-widget">
            <i class="icon icofont-ui-alarm text-danger"></i>
            <div class="info">
                <span class="main text-danger <?=$activeClock=='exitTime' ?'active-clock':''?>">
                    <?= $exitTime->format('H:i:s'); ?>
                </span>
                <span class="label text-muted">Hora de Saída</span>
            </div>
        </div>
    </div>
</aside>