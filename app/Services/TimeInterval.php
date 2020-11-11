<?php

namespace App\Services;

class TimeInterval
{
    public const SECOND = 1;
    public const MINUTE = 2;
    public const HOUR = 3;
    public const DAY = 4;
    public const WEEK = 5;
    public const MONTH = 6;
    public const YEAR = 7;

    public static function intervalsArray() : array
    {
        return [
            self::SECOND, self::MINUTE, self::HOUR, self::DAY, self::WEEK,
            self::MONTH, self::YEAR
        ];
    }

    public static function mappedIntervalsArray() : array
    {
        return [
            self::SECOND => 'Seconds',
            self::MINUTE => 'Minutes',
            self::HOUR => 'Hours',
            self::DAY => 'Days',
            self::WEEK => 'Weeks',
            self::MONTH => 'Months',
            self::YEAR => 'Years',
        ];
    }

    public static function intervalsValidation() : string
    {
        return implode(",", self::intervalsArray());
    }

    public static function dropdownOptions() : array
    {
        return [
            [ "label" => "Second(s)", "value" => self::SECOND ],
            [ "label" => "Minute(s)", "value" => self::MINUTE ],
            [ "label" => "Hour(s)", "value" => self::HOUR ],
            [ "label" => "Day(s)", "value" => self::DAY ],
            [ "label" => "Week(s)", "value" => self::WEEK ],
            [ "label" => "Month(s)", "value" => self::MONTH ],
            [ "label" => "Year(s)", "value" => self::YEAR ]
        ];
    }
}
