<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types = 1);

class TwelveDays
{
    private array $gifts = [
        12 => 'twelve Drummers Drumming',
        11 => 'eleven Pipers Piping',
        10 => 'ten Lords-a-Leaping',
        9  => 'nine Ladies Dancing',
        8  => 'eight Maids-a-Milking',
        7  => 'seven Swans-a-Swimming',
        6  => 'six Geese-a-Laying',
        5  => 'five Gold Rings',
        4  => 'four Calling Birds',
        3  => 'three French Hens',
        2  => 'two Turtle Doves',
        1  => 'a Partridge in a Pear Tree',
    ];

    private array $days = [
        1  => 'first',
        2  => 'second',
        3  => 'third',
        4  => 'fourth',
        5  => 'fifth',
        6  => 'sixth',
        7  => 'seventh',
        8  => 'eighth',
        9  => 'ninth',
        10 => 'tenth',
        11 => 'eleventh',
        12 => 'twelfth',
    ];

    private string $line = 'On the %s day of Christmas my true love gave to me: ';

    public function recite(int $start, int $end): string
    {
        $lines = [];

        while ($start <= $end) {
            $lines[] = $this->getLineForDay($start);
            $start++;
        }

        if ($start !== $end) {
            return implode(PHP_EOL, $lines);
        }


        return implode(' ', $lines);
    }

    private function getLineForDay(int $day)
    {
        $giftlist = $this->addGifts($day);

        return sprintf($this->line, $this->days[$day]) . $giftlist;
    }

    private function addGifts(int $day): string
    {
        if ($day === 1) {
            return $this->gifts[1] . '.';
        }

        $giftList = '';

        while (2 <= $day) {
            $giftList .= $this->gifts[$day] . ', ';
            $day--;
        }

        $giftList = $giftList . 'and ' . $this->gifts[1] . '.';

        return $giftList;
    }
}
