<h3>Testes</h3>
<?php
$adm = WorkingHours::getOne(['id'=>178]);
echo '<pre>';
print($adm->getExitTime()->format('H:i:s'));
echo '</pre>';