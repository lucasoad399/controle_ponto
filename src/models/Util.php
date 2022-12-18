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
}