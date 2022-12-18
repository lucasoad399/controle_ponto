<?php

function calculateIntervalInSeconds(string $time1, string $time2){
    $turn1 = new DateTime($time2);
    $turn1 = $turn1->diff(new DateTime($time1));
    $acc = 0;
    $acc =  (float)((float) $turn1->format('%s') ) + 
            (60 * (float) $turn1->format('%i') ) +
            (60*60* (float) $turn1-> format('%H'));
    return $acc;
}

function calculateWorkedTime(array $workDay){
    return calculateIntervalInSeconds($workDay[0], $workDay[1]) + calculateIntervalInSeconds($workDay[2], $workDay[3]);

}



function getDayTemplatByOdds($regularRate, $extraRate, $lazyRate){
    if($regularRate + $extraRate + $lazyRate >100) throw new Exception("Valor superior a 100%");
    $regularDay = [
        '08:00:00',
        '12:00:00',
        '14:00:00',
        '18:00:00'
   ];
   $regularDay[] = calculateWorkedTime($regularDay);
   
   $extraHourDay = [
       '08:00:00',
       '12:41:00',
       '14:00:00',
       '19:00:30'
   ];
   $extraHourDay[] = calculateWorkedTime($extraHourDay);
   
   $lazyDay = [
       '08:00:00',
       '11:20:00',
       '14:00:00',
       '17:40:30'
   ];
   $lazyDay[] = calculateWorkedTime($lazyDay);


   $sort = rand(0,100);

    if($sort<= $regularRate){
        $finalValue =  $regularDay;
    } elseif ($sort <=$regularRate = $extraRate) {
        $finalValue =  $extraHourDay;
    }else{
        $finalValue =  $lazyDay;
    }

    $keysOfFinalValue = [
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time',
    ];
    return array_combine($keysOfFinalValue, $finalValue);
}

function populatingWorkingHours(
    $userId, 
    $initialDate, 
    $regularRate, 
    $extraRate, 
    $lazyRate
    )
    {
        try {
            (new WorkingHours(['user_id'=>$userId]))->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        // limpei a tabela;
        echo 'limpei a tabela<br>';
        $currentDate = $initialDate;
        $today = new DateTime();
        $columns = [
            'user_id'   => $userId,
            'work_date' => $currentDate,
        ];
        echo 'insesão em loop<br>';
        while(Util::isBefore($currentDate, $today)){
            $template = getDayTemplatByOdds($regularRate, 
            $extraRate, 
            $lazyRate);
            $columns = array_merge($columns, $template);
            $workingHours = new WorkingHours($columns);
            
            $workingHours->save();
            $currentDate = Util::getNextDay($currentDate)->format('Y-m-d');
            $columns['work_date'] = $currentDate;

        }

}
$lastMonth = strtotime('first day of last month');


// populatingWorkingHours(1, date('Y-m-d', $lastMonth),70,20,10);
// populatingWorkingHours(3, date('Y-m-d', $lastMonth),70,20,10);
// populatingWorkingHours(4, date('Y-m-d', $lastMonth),20,10,70);
// echo gettype($regularDay);



// $conn= new Database();
// $conn = $conn->getConnection();
// $conn->exec('DELETE FROM working_hours'); //incrivelmente funciona;