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

class Robot
{
    private $name;
    private $possibleNames = [];

    public function __construct()
    {
        $this->generatePossibleNames();
        $this->setNewName();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function reset(): void
    {
        $oldName = $this->name;

        if (false === empty($oldName) && in_array($oldName, $this->possibleNames)){
            $key = array_search($oldName, $this->possibleNames);
            unset($this->possibleNames[$key]);
        }

        $this->resetKeys();
        $this->setNewName();
    }

    private function setNewName(): void
    {
        $this->name = $this->possibleNames[$this->generateRandomIndex()];
    }

    private function generateRandomIndex()
    {
        $possibilities = count($this->possibleNames) - 1;
        $randomIndex   = rand(0, $possibilities);


        if (false === empty($this->possibleNames[$randomIndex])) {
            return $randomIndex;
        }

        $this->generateRandomIndex();
    }

    private function generatePossibleNames():void
    {
        $i = 0;
        while ($i < 60000) {
            $letters = chr(rand(65, 90)) . chr(rand(65, 90));
            $numbers = (int)substr((string)mt_rand(0, 1000000000), 0, 3);
            $name    = $letters . $numbers;

            if (false === in_array($name, $this->possibleNames)) {
                $this->possibleNames[] = $name;
                $i++;
            }
        }

        shuffle($this->possibleNames);
        $this->resetKeys();
    }

    private function resetKeys()
    {
        $this->possibleNames = array_values($this->possibleNames);
    }
}
