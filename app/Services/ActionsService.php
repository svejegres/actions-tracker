<?php

namespace App\Services;

class ActionsService
{
    public const WORKING_HOURS_IN_ONE_DAY = 8;

    /**
     * Convert into minutes such values as "45m", "1h", "1h 15m", "1d", etc.
     *
     * @param  string  $time
     * @return int
     */
    public function getTimeInMinutes(string $time): int
    {
        $time = explode(' ', trim($time));

        $timeInMinutes = intval($time[0]) * $this->getTimeValueMultiplier($time[0][-1]);

        if (isset($time[1])) {
            $timeInMinutes += intval($time[1]) * $this->getTimeValueMultiplier($time[1][-1]);
        }

        return $timeInMinutes;
    }

    /**
     * Convert minutes into such values as "45m", "1h", "1h 15m", "1d", etc.
     *
     * @param  string  $minutes
     * @return string
     */
    public function getMinutesInTime(string $minutes): string
    {
        $minutes = intval($minutes);
        $hours = floor($minutes / 60);
        $days = floor($hours / self::WORKING_HOURS_IN_ONE_DAY);

        $m = $minutes % 60;
        $h = $hours % self::WORKING_HOURS_IN_ONE_DAY;
        $d = $days;

        $m = $m > 0 ? "{$m}m" : '';
        $h = $h > 0 ? "{$h}h" : '';
        $d = $d > 0 ? "{$d}d" : '';

        return str_replace('  ', ' ', trim("$d $h $m"));
    }

    /**
     * @param  string  $timeValue
     * @return int
     */
    private function getTimeValueMultiplier(string $timeValue): int
    {
        switch ($timeValue) {
            case 'm':
                return 1;
            case 'h':
                return 60;
            case 'd':
                return 60 * self::WORKING_HOURS_IN_ONE_DAY;
            default:
                return 1;
        }
    }
}