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

declare(strict_types=1);

class ResistorColorDuo
{
    public function getColorsValue(array $colors): string
    {
        $firstValue = '';
        $secondValue = '';

        if (isset($colors[0])){
            $firstValue = (string)$this->getValueFromColor($colors[0]);
        }

        if (isset($colors[1])){
            $secondValue = (string)$this->getValueFromColor($colors[1]);
        }

        return $firstValue . $secondValue;
    }


    private function getValueFromColor(string $color): int
    {
        switch (ucfirst($color)) {
            case 'Black':
                return 0;
            case 'Brown':
                return 1;
            case 'Red':
                return 2;
            case 'Orange':
                return 3;
            case 'Yellow':
                return 4;
            case 'Green':
                return 5;
            case 'Blue':
                return 6;
            case 'Violet':
                return 7;
            case 'Grey':
                return 8;
            case 'White':
                return 9;
            default:
                throw new \Exception('Color does not exist');
        }
    }
}
