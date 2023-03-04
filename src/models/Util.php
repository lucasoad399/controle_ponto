<?php

Class Util{
    public static function getDateAsDateTime($date){
        return is_string($date)? new DateTime($date): $date;
    }

    public static function isWeekent($date){
        $inputDate = self::getDateAsDateTime($date);
        return $inputDate->format('N') >=6;
    }
    public static function isBefore($date1, $date2){
        $inputDate1 = self::getDateAsDateTime($date1);
        $inputDate2 = self::getDateAsDateTime($date2);
        return $inputDate1 <= $inputDate2;
    }

    public static function getNextDay($date){
        $inputDate = self::getDateAsDateTime($date);
        $inputDate->modify('+ 1 day');
        return $inputDate;
    }

    public static function sumIntervals($interval1, $interval2){
        $date1 = new DateTime('00:00:00');
        $date1->add($interval1);
        $date1->add($interval2);

        $date2 = new DateTime('00:00:00');
        

        
        return $date2->diff($date1);
    }

    public static function subIntervals($interval1, $interval2){
        $date1 = new DateTime('00:00:00');
        $date1->add($interval1);
        $date1->sub($interval2);

        $date2 = new DateTime('00:00:00');
    }

    public static function getDateFromInterval($interval){
        return new DateTimeImmutable($interval->format('%H:%i:%s'));
    }

    public static function getDateFromString($str){
        return  DateTimeImmutable::createFromFormat('H:i:s', $str);
    }

    public static function getFirstDayOfMonth($date){
        $time =  SELF::getDateAsDateTime($date)->getTimestamp();
        return (new DateTime(date('Y-m-1', $time)));
    }
    public static function getLastDayOfMonth($date){
        $time =  SELF::getDateAsDateTime($date)->getTimestamp();
        return (new DateTime(date('Y-m-t', $time)));
    }

    public static function secondsToHours($seconds){
        $signal = '';
        if($seconds<0){
            $signal = '-';
            $seconds = abs($seconds);
        }
        $h = floor($seconds/3600);
        $m = floor( ($seconds - $h*3600)/60  );
        $s = floor(($seconds - $m*60 - $h*3600));
    
    
        $strTime =  "$h:$m:$s";
        $arrayTime = explode(':', $strTime);
        foreach ($arrayTime as &$value) {
            // echo $value[0].'<br>';
            if(strlen($value)<2 && $value[0]!='-') $value = '0'.$value;
            
        }
        $strTime = implode(':',$arrayTime);
    
        return  $signal . $strTime;
    }

    public static function formataData($strData, $yearType='FULL'){
        $fmt = new IntlDateFormatter( 'pt_BR' ,constant("IntlDateFormatter::".$yearType), IntlDateFormatter::NONE,
        'America/Sao_Paulo',IntlDateFormatter::GREGORIAN  );

        return $fmt->format(strtotime($strData));
    }

    public static function formataMes($strData){
        $cal = IntlCalendar::fromDateTime($strData, 'America/Sao_Paulo');

        return  IntlDateFormatter::formatObject($cal, " MMMM' de 'y", 'pt_BR');
    }

    
}