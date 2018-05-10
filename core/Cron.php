<?php
namespace Core;
/**
 * Description of Cron
 *
 * @author jorge
 */
class Cron
{
    public function __construct()
    {
        return self::$this;
    }

    public static function validate($schedule)
    {
        if (self::validateMonth($schedule->month))
            if (self::validateWeek($schedule->week))
                if (self::validateDay($schedule->day))
                    if (self::validateHour($schedule->hour))
                        if (self::validateHour($schedule->minute))
                            return true;
        return false;
    }

    protected static function validateMonth($month)
    {
        return ($month == "*" || $month == date("m")) ? true : false;
    }

    protected static function validateWeek($week)
    {
        return ($week == "*" || $week == date("w")) ? true : false;
    }

    protected static function validateDay($day)
    {
        return ($day == "*" || $day == date("d")) ? true : false;
    }

    protected static function validateHour($hour)
    {
        return ($hour == "*" || $hour == date("h")) ? true : false;
    }

    protected static function validateMinute($minute)
    {
        return ($minute == "*" || $minute == date("s")) ? true : false;
    }
}
