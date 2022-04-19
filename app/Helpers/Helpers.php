<?php

namespace App\Helpers;

class Helpers
{
    public static function fibonacci($num)
    {
        $first = 0;
        $second = 1;
        for ($i = 0; $i < $num - 1; $i++) {
            $output = $second + $first;

            $first = $second;
            $second = $output;
        }
        return $num == 1 ? 0 : ($num == 3 ? $output - 1 : $output);
    }

    public static function prima($num)
    {
        if ($num != 1) {
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % 2 == 0) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}
