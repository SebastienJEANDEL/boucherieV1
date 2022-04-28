<?php

// Attention à l'ordre des inclusions par rapport à l'héritage
// Si BorderCollie hérite de Chien, alors Chien doit être inclus avant
require __DIR__ . '/Classes/Animal.php';
require __DIR__ . '/Classes/Chien.php';
require __DIR__ . '/Classes/BorderCollie.php';
require __DIR__ . '/Classes/EpagneulBreton.php';

echo '----------------------------------------------------<br>';
echo 'Mon chien (Border Collie)<br>';
echo '----------------------------------------------------<br>';
$monChien = new BorderCollie();
var_dump($monChien);
$monChien->visMaVie();
var_dump($monChien);

echo '----------------------------------------------------<br>';
echo 'Ton chien (Epagneul Breton)<br>';
echo '----------------------------------------------------<br>';
$tonChien = new EpagneulBreton();
var_dump($tonChien);
$tonChien->visMaVie();
var_dump($tonChien);