<?php

if (!function_exists('abbreviateNumber')) {
    function abbreviateNumber($number, $precision = 1)
    {
        if ($number < 1000) {
            return $number;
        }

        $units = ['K', 'M', 'B', 'T'];
        $power = floor((strlen((int) $number) - 1) / 3);
        $unit = $units[$power - 1];

        return round($number / pow(1000, $power), $precision) . $unit;
    }
}
