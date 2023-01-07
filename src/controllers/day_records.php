<?php

$user = Login::requireValideSession();


$formatedDay = (new DateTime())/*->modify('-1 day')*/->format('Y-m-d');
$cal = IntlCalendar::fromDateTime( $formatedDay , 'pt_BR');
$today = IntlDateFormatter::formatObject($cal, "d ' de ' MMMM ' de ' yyyy ");

//Carregando a jornada do dia;
$register = WorkingHours::loadFromUserAndDate($_SESSION['user']->id, $formatedDay);

$exitTime = $register->getExitTime();
$workedTime = $register->getWorkedInterval();

$activeClock = $register->activeClock();

sisLoad('view', 'templates/header',['user'=>$user]);
sisLoad('view','templates/aside', [
    'exitTime'=>$exitTime,
    'workedTime'=>$workedTime,
    'activeClock'=>$activeClock
]);

$main = $_GET['main'] ?? 'day_records';
if($main == 'monthly_report') {
    require_once 'monthly_report.php';
    // sisLoad('view', $main, [
    //     'today'=>$today,
    //     'register'=>$register,
    //     'teste'=>$teste
    // ]);

} else{
    sisLoad('view', $main, [
        'today'=>$today,
        'register'=>$register
    ]);
}


sisLoad('view', 'templates/footer', [
    'exitTime'=>$exitTime,
    'workedTime'=>$workedTime
]);
