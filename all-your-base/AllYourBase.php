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

function rebase(int $number, array $sequence, int $base)
{
    if (false === isValid($number, $sequence, $base)) {
        return null;
    }

    if (10 === $number) {
        $numberInTenBase = (int)implode("", $sequence);
    }

    if (false === isset($numberInTenBase)) {
        $numberInTenBase = sequenceToTenBase($sequence, $number);
    }

    if (10 === $base) {
        return str_split((string)$numberInTenBase, 1);
    }

    $sequenceInTargetBase = tenBaseToBase($numberInTenBase, $base);

    return $sequenceInTargetBase;
}

function isValid(int $number, array $sequence, int $base): bool
{
    if (
        empty($sequence)
        || 0 === $sequence[0]
        || 0 >= $number
        || $number < $sequence[0]
        || 1 >= $base
    ) {
        return false;
    }

    $wrongValues = array_filter($sequence, function ($element) use ($number) {
        return $element < 0 || $element >= $number;
    });

    if (false === empty($wrongValues)) {
        return false;
    }

    return true;
}

function sequenceToTenBase(array $sequence, int $base): int
{
    $number = 0;

    foreach (array_reverse($sequence) as $exponent => $element) {
        $number += $element * pow($base, $exponent);
    }

    return $number;
}

function tenBaseToBase(int $numberInTenBase, int $targetBase): array
{
    $sequence = [];

    while ($numberInTenBase > 0) {
        $sequence[]      = $numberInTenBase % $targetBase;
        $numberInTenBase = intdiv($numberInTenBase, $targetBase);
    }

    return array_reverse($sequence);
}
