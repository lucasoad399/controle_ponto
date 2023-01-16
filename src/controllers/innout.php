<?php
echo 'INNOUT<hr>';
Login::requireValideSession();
$register = WorkingHours::loadFromUserAndDate($_SESSION['user']->id, (new DateTime())->format('Y-m-d'));



// echo '<pre>';
// print_r($register);
// echo '</pre>';

try {

    $moment = $_POST['simulated_time'] ?? (new DateTime)->format('H:i:s');
    $register->innout($moment);
    // unset($_POST['simulated_time']);
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


// echo '<pre>';
// print_r($register);
// echo '</pre>';

header('Location: /'); 