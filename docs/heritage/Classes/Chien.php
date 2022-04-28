<?php

class Chien extends Animal
{
    protected $nombresDePattes = 4;

    // Avec la visibilité private, même une classe enfant comme BorderCollie
    // qui extends Chien ne peut pas accéder à la méthode ou à la propriété
    // Si on veut ouvrir l'accès (sans pour autant passer en visibilité public)
    // => on utilise protected qui ouvre l'accès aux classes enfants (et parents également même si c'est moins courant)
    protected function aboyer()
    {
        echo 'Ouaf !<br>';
    }

    protected function marcher()
    {
        echo 'Je marche à ' . $this->nombresDePattes . ' pattes<br>';
    }
}