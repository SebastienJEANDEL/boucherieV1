<?php

class EpagneulBreton extends Chien
{
    private function chasser()
    {
        echo 'Ca sent le gibier, je vais suivre la piste...<br>';
    }

    public function visMaVie()
    {
        $this->aboyer();
        $this->chasser();
        $this->manger();
        $this->marcher();
        $this->dormir();
        $this->mourir();
    }
}