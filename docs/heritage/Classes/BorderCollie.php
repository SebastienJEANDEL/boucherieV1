<?php

// Avec extends, on indique qu'on étend de la classe située après (ici : Chien)
// Cela permet d'accéder au code présent dans la classe Chien (mais
// attention sous certaines conditions)
class BorderCollie extends Chien
{
    private function troupeauter()
    {
        echo 'Pas bouger les moutons !<br>';
    }

    public function visMaVie()
    {
        $this->aboyer(); // J'essaie de dire quelque chose à mon maître mais il ne comprend jamais rien
        $this->troupeauter(); // C'est mon activité favorite
        $this->manger(); // Ca fait du bien de reprendre des forces
        $this->marcher(); // Un peu de marche pour bien digérer
        $this->dormir(); // Ca fait du bien de se reposer
        $this->mourir(); // J'ai eu une vie bien remplie mais toutes les bonnes choses ont une fin...
    }
}