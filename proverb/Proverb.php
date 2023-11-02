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

class Proverb
{
    public function recite(array $content)
    {
        if (empty($content)) {
            return [];
        }

        $lastSentence[] = 'And all for the want of a ' . $content[0] . '.';
        $contentLength  = count($content);

        if (count($content) == 1) {
            return $lastSentence;
        }

        $proverb = [];
        $i       = 0;

        while ($i + 1 < $contentLength) {
            $proverb[] = 'For want of a ' . $content[$i] . ' the ' . $content[$i + 1] . ' was lost.';
            $i++;
        }

        $proverb = array_merge($proverb, $lastSentence);

        return $proverb;
    }
}
