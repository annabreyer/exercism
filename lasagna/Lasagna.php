<?php

declare(strict_types=1);

class Lasagna
{
    private int $cookTime = 40;
    private int $preparationTimePerLayer = 2;

    public function expectedCookTime(): int
    {
        return $this->cookTime;
    }
    public function remainingCookTime(int $elapsed_minutes):int
    {
        return $this->expectedCookTime()-$elapsed_minutes;
    }

    public function totalPreparationTime(int $layers_to_prep):int
    {
        return $layers_to_prep * $this->preparationTimePerLayer;
    }

    public function totalElapsedTime(int $layers_to_prep, int $elapsed_minutes): int
    {
        return $elapsed_minutes + $this->totalPreparationTime($layers_to_prep);
    }

    public function alarm()
    {
        return "Ding!";
    }
}
