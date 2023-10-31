<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        $initial = substr($name, 0,1);

        return $initial;
    }

    public function initial(string $name): string
    {
        return strtoupper($this->firstLetter($name)) . ".";
    }

    public function initials(string $name): string
    {
        $names = explode(' ', $name);

        return $this->initial($names[0]) . ' ' . $this->initial($names[1]);

    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        $sweethearts = $this->initials($sweetheart_a) . '  +  ' . $this->initials($sweetheart_b);

        return <<<EXPECTED_HEART
                 ******       ******
               **      **   **      **
             **         ** **         **
            **            *            **
            **                         **
            **     $sweethearts     **
             **                       **
               **                   **
                 **               **
                   **           **
                     **       **
                       **   **
                         ***
                          *
            EXPECTED_HEART;
    }
}
