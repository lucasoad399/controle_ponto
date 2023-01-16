<?php
class WorkingHours extends Model{
    protected static $tableName = 'working_hours';
    protected static array $columns = [
        'id',
        'user_id',
        'work_date',
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time'
    ];

    public static function loadFromUserAndDate($userId, $workDate){
        $registry = self::getOne(['user_id'=>$userId, 'work_date'=>$workDate]);

        if(!$registry){
            $registry = new WorkingHours([
                'user_id'=> $userId,
                'work_date'=> $workDate,
                'worked_time'=> 0
            ]);
        }

        return $registry;
    }

    public function getNextTime(){
        if(!$this->time1) return 'time1';
        if(!$this->time2) return 'time2';
        if(!$this->time3) return 'time3';
        if(!$this->time4) return 'time4';    
        return null;
    }


    public function innout(string $time){
        $nextTime = $this->getNextTime();
        $nextTime ? $this->$nextTime = $time: throw new Exception('Preenchidos todos os batimentos do dia');
        if(!$this->id){
            $this->insert();
        }else{
            if($this->time4){
                echo '<br>'. 'Time4: '. $this->time4 . '<br>';
                $this->worked_time =  self::calculateWorkedTime([
                    $this->time1,
                    $this->time2,
                    $this->time3,
                    $this->time4,
                ]);

                
            }
           

            // if(is_null($this->time4)){
                $this->update();
            // }
        }
    }

    public static function calculateWorkedTime(array $workDay){
        return self::calculateIntervalInSeconds($workDay[0], $workDay[1]) + self::calculateIntervalInSeconds($workDay[2], $workDay[3]);
    
    }

    public static function calculateIntervalInSeconds(string $time1, string $time2){
        $turn1 = new DateTime($time2);
        $turn1 = $turn1->diff(new DateTime($time1));
        $acc = 0;
        $acc =  (float)((float) $turn1->format('%s') ) + 
                (60 * (float) $turn1->format('%i') ) +
                (60*60* (float) $turn1-> format('%H'));

                echo '<hr>'.$acc.'<hr>';
        return $acc;
    }

    function getWorkedInterval(){
        [$t1, $t2, $t3, $t4] = $this->getTimes();

        $part1 = new DateInterval('PT0S');
        $part2 = new DateInterval('PT0S');

        if($t1) $part1 = $t1->diff(new DateTime());
        if($t2) $part1 = $t1->diff($t2);

        if($t3) $part2 = $t3->diff(new DateTime());
        if($t4) $part2 = $t3->diff($t4);

        return Util::sumIntervals($part1, $part2);

    }
    function getLunchInterval(){
        [, $t2, $t3, ] = $this->getTimes();

        $lunchInterval = new DateInterval('PT0S');
        if ($t2) $lunchInterval = $t2->diff(New DateTime);
        if ($t3) $lunchInterval = $t2->diff($t3);
        return $lunchInterval;
    }

    function getExitTime(){
        [$t1,$t2,$t3,$t4] =$this->getTimes();
        if($t4) return $t4;
        if(!$t1) return (new DateTime())->add(new DateInterval('PT09H'));
        
        $workedInterval = $this->getWorkedInterval();
        
  
        $expectedWorkTime = new DateTime('08:00:00');
        
        
        if(Util::getDateFromInterval($workedInterval) > $expectedWorkTime)
            return (new DateTime());
            
            $diffWorkedExpected = Util::getDateFromInterval($workedInterval)->diff($expectedWorkTime);
            return ((new DateTime())->add($diffWorkedExpected));
        /*Se o tempo trabalhado for maior que o esperado o cara deve sair imediatamente,
        senão ele calcula a diferença entre o tempo trabalhado e o esperado que ele trabalha, pega a hora atual e soma essa diferença;
        */

    }

    private function getTimes(){
        $times = [];

        for($i=1;$i<=4;$i++){
            $times[] = $this->{'time'. $i}? Util::getDateFromString($this->{'time'. $i}): null;
        }
        return $times;
    }

    public function activeClock(){
        $nextTime = $this->getNextTime();
        if($nextTime === 'time1' || $nextTime === 'time3'){
            return 'exitTime';
        }else if($nextTime === 'time2' || $nextTime === 'time4'){
            return 'workingHours';
        } 
        return null;
    }

    public static function getMonthlyReport($user_id, $date){
        $registries = [];
        $startDate = Util::getFirstDayOfMonth($date);
        $endDate = Util::getLastDayOfMonth($date);

        for($date = $startDate; $date <= $endDate; $date->modify('+1 day') ){
            $registrie = self::getOne([
                'user_id'=>$user_id,
                'work_date'=>$date->format('Y-m-d')
            ]);

            if(!is_null($registrie)){
                $registries[$registrie->work_date] = $registrie;
            }
        }

        return $registries;
    }
}