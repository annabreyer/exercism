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
    if (
        empty($sequence)
        || 0 === $sequence[0]
        || 0 >= $number
        || $number < $sequence[0]
        || 1 >= $base
    ) {
        return null;
    }

    $wrongValues = array_filter($sequence, function($element) use ($number){
        return $element < 0 ||$element >= $number;
    });

    if (false === empty($wrongValues)){
        return null;
    }

    $sequenceLength = count($sequence);
    $initialBase    = generateBaseSequence($number, $sequenceLength);

    if (10 === $number) {
        $numberInTenBase = (int)implode("", $sequence);
    }

    if (false === isset($numberInTenBase)) {
        $numberInTenBase = sequenceToTenBase($sequence, $initialBase, $base);
    }

    if (10 === $base) {
        return str_split((string)$numberInTenBase, 1);
    }

    $sequenceInTargetBase = tenBaseToBase($numberInTenBase, $base, $number, $sequenceLength);

    return $sequenceInTargetBase;
}

function generateBaseSequence(int $base, int $sequenceLength): array
{
    $baseSequence = [];
    $exponent     = 0;

    while ($exponent < $sequenceLength) {
        $baseSequence[] = pow($base, $exponent);
        $exponent++;
    }

    return $baseSequence;
}

function sequenceToTenBase(array $sequence, array $baseSequence, int $base): int
{
    $number = 0;

    foreach (array_reverse($sequence) as $key => $element) {
        $number += $element * $baseSequence[$key];
    }

    return $number;
}

function tenBaseToBase(int $numberInTenBase, int $targetBase, int $initialBase, int $sequenceLength): array
{
    $sequence           = [];
    $necessaryExponents = getNecessaryExponent($initialBase, $sequenceLength, $targetBase, $numberInTenBase);
    $newBase            = array_reverse(generateBaseSequence($targetBase, $necessaryExponents));

    foreach ($newBase as $baseElement) {
        $timesBase       = intval(floor($numberInTenBase / $baseElement));
        $sequence[]      = $timesBase;
        $numberInTenBase -= $timesBase * $baseElement;

        if ($numberInTenBase < 0) {
            break;
        }
    }

    $sequence = trimZeros($sequence);

    return $sequence;
}

function trimZeros(array $sequence)
{
    foreach ($sequence as $key => $value) {
        if (0 !== $value) {
            break;
        }

        unset($sequence[$key]);
    }

    return array_values($sequence);
}

//TODO find another way then the xponent to generate the base array, maybe substract or whatever, the current way does not work for all
function getNecessaryExponent(int $number, int $sequenceLength, int $base, int $numberInTenBase)
{
    $necessaryExponents = (string)intval(ceil($numberInTenBase / $base));
    $necessaryExponents = strlen($necessaryExponents);

//    $necessaryExponents = $sequenceLength;
//
//    if ($number < $base) {
//        $necessaryExponents = intval(ceil(pow($numberInTenBase, (1 / $base))));
//    }
//
//    if ($base < $number) {
//        $necessaryExponents = (string)intval(ceil($numberInTenBase / $base));
//        $necessaryExponents = strlen($necessaryExponents);
//    }

    return $necessaryExponents;
}
