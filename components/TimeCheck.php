<?php

namespace app\components;

use app\models\Classes;

class TimeCheck {

    public static function classIsOnGoing($class, $dateTime){
        //check day
        $days = ['N','M','T','W','H','F','S'];
        
        $day = $days[date('w', $dateTime)];
        
        $classDays = str_split($class->day);
        
        if(!in_array($day, $classDays)) return false;

        
        //check time
        $startTime = strtotime($class->start);
        $endTime = strtotime($class->end);

        if($dateTime > $startTime && $dateTime < $endTime) {
            return true;
        }else {
            return false;
        }
    }

}
