<?php

$user = Login::requireValideSession();


$formatedDay = (new DateTime())->modify('-1 day')->format('Y-m-d');
$cal = IntlCalendar::fromDateTime( $formatedDay , 'pt_BR');
$today = IntlDateFormatter::formatObject($cal, "d ' de ' MMMM ' de ' yyyy ");

//Carregando a jornada do dia;
$register = WorkingHours::loadFromUserAndDate($_SESSION['user']->id, $formatedDay);
// echo $formatedDay . "<br>";
// echo '<pre>';
// print_r($register);
// echo '</pre>';

//Carregando Layout;


sisLoad('view', 'templates/header',['user'=>$user]);
sisLoad('view','templates/aside');
sisLoad('view', 'day_records', [
    'today'=>$today,
    'register'=>$register
]);
sisLoad('view', 'templates/footer');
