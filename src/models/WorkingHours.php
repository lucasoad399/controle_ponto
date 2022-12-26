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

    
}