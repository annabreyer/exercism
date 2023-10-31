<?php

class AnnalynsInfiltration
{
    public function canFastAttack(bool $is_knight_awake): bool
    {
        if ($is_knight_awake){
            return false;
        }

        return true;
    }

    public function canSpy(
        $is_knight_awake,
        $is_archer_awake,
        $is_prisoner_awake
    ) {
        if ($is_knight_awake || $is_archer_awake || $is_prisoner_awake){
            return true;
        }
        return false;
    }

    public function canSignal(
        $is_archer_awake,
        $is_prisoner_awake
    ) {
        if ($is_prisoner_awake && false === $is_archer_awake){
            return true;
        }

        return false;
    }

    public function canLiberate(
        $is_knight_awake,
        $is_archer_awake,
        $is_prisoner_awake,
        $is_dog_present
    ) {
        if ($is_dog_present && false === $is_archer_awake){
            return true;
        }

        if (false === $is_prisoner_awake){
            return false;
        }

        if (false === $is_dog_present && false === $is_archer_awake && false === $is_knight_awake){
            return true;
        }

        return false;

    }
}
