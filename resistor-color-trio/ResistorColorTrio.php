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

class ResistorColorTrio
{
    public function label(array $colors): string
    {
        $firstValue  = '';
        $secondValue = '';
        $ohms        = 'ohms';
        $i           = 0;
        $zeros       = '';

        if (isset($colors[0])) {
            $firstValue = (string)$this->getValueFromColor($colors[0]);
        }

        if (isset($colors[1])) {
            $secondValue = (string)$this->getValueFromColor($colors[1]);
        }

        if (isset($colors[2])) {
            $thirdValue = $this->getValueFromColor($colors[2]);
            while ($i < $thirdValue) {
                $zeros .= '0';
                $i++;
            }
        }

        $label = $this->applyMetricPrefix($firstValue,$secondValue,$zeros);

        return $label . $ohms;
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

    private function applyMetricPrefix(string $firstValue, string $secondValue, string $zeros)
    {
        $metricPrefix = '';
        if ('0' === $firstValue && '0' === $secondValue){
            $firstValue = '';
        }

        if ('0' === $firstValue && '0' !== $secondValue){
            $firstValue = '';
        }

        if ('0' !== $firstValue && '0' === $secondValue){
            $secondValue = '';
            $zeros .= '0';
        }

        if (strlen($zeros) >= 9){
            $metricPrefix = 'giga';
            $zeros = substr($zeros, 9);
        }

        if (strlen($zeros) >= 6){
            $metricPrefix = 'mega';
            $zeros = substr($zeros, 6);
        }

        if (strlen($zeros) >= 3){
            $metricPrefix = 'kilo';
            $zeros = substr($zeros, 3);
        }

        return $firstValue . $secondValue . $zeros . ' ' . $metricPrefix;
    }
}
