<?php

$user = Login::requireValideSession();


$formatedDay = (new DateTime())/*->modify('-1 day')*/->format('Y-m-d');
$cal = IntlCalendar::fromDateTime( $formatedDay , 'pt_BR');
$today = IntlDateFormatter::formatObject($cal, "d ' de ' MMMM ' de ' yyyy ");

//Carregando a jornada do dia;
$register = WorkingHours::loadFromUserAndDate($_SESSION['user']->id, $formatedDay);

$exitTime = $register->getExitTime();
$workedTime = $register->getWorkedInterval();


sisLoad('view', 'templates/header',['user'=>$user]);
sisLoad('view','templates/aside', [
    'exitTime'=>$exitTime,
    'workedTime'=>$workedTime
]);
sisLoad('view', 'day_records', [
    'today'=>$today,
    'register'=>$register
]);
sisLoad('view', 'templates/footer', [
    'exitTime'=>$exitTime,
    'workedTime'=>$workedTime
]);
