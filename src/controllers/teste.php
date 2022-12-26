<h3>Testes</h3>
<?php
$i1= DateInterval::createFromDateString('5 days');

$i2= DateInterval::createFromDateString('3 days');

$sum =  Util::sumIntervals($i1,$i2);
$date = Util::getDateFromInterval($sum);
echo '<pre>';
print_r($date);
echo '</pre>';
