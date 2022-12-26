<?php
echo 'INNOUT<hr>';
Login::requireValideSession();
$register = WorkingHours::loadFromUserAndDate($_SESSION['user']->id, (new DateTime())->format('Y-m-d'));



// echo '<pre>';
// print_r($register);
// echo '</pre>';

try {

    // $register->innout((new DateTime)->format('H:i:s')); // Versão sem o teste simulado
    $register->innout($_POST['simulated_time']??(new DateTime)->format('H:i:s')); //versão com o teste simulado

    $_POST['simulated_time'] ?? $register->innout($_POST['simulated_time']);
    unset($_POST['simulated_time']);
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => 'Ponto Registrado com sucesso'
    ];
} catch (\Exception $e) {
    $_SESSION['message'] = [
        'type' => 'error',
        'message' => $e->getMessage()
    ];
    echo $e->getMessage();
}


echo '<pre>';
print_r($register);
echo '</pre>';

header('Location: /'); 