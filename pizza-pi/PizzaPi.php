<?php

class PizzaPi
{
    public function calculateDoughRequirement(int $pizzas, int $persons): int
    {
        $dough = $pizzas * (($persons * 20) + 200);

        return $dough;
    }

    public function calculateSauceRequirement(int $pizzas): int
    {
        $numberOfCans = $pizzas * 0.5;

        return $numberOfCans;
    }

    public function calculateCheeseCubeCoverage($sideLength, $thickness, $diameter): int
    {
        $pizzas = pow($sideLength, 3) / ($thickness * pi() * $diameter);

        return $pizzas;
    }

    public function calculateLeftOverSlices(int $pizzas, int $friends)
    {
        $slices = $pizzas * 8;

        while($slices >= $friends){
            $slices = $slices - $friends;
        }

        return $slices;
    }
}
