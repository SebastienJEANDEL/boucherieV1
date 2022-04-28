<?php

class Animal
{
    private $estVivant = true;

    protected function manger()
    {
        echo 'Miam<br>';
    }

    protected function dormir()
    {
        echo 'Rrrrrrrrrrr Rrrrrrrrrrrrrr Pffffffffff<br>';
    }

    protected function mourir()
    {
        $this->estVivant = false;
        echo 'Je crois que c\'est la fin...sniff...<br>';
    }
}