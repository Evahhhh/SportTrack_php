<?php
require_once 'CalculDistanceImpl.php';


$classCalc = new CalculDistanceImpl();

$parcours = [
    ['latitude' => 47.644795, 'longitude' => -2.776605],
    ['latitude' => 47.646870, 'longitude' => -2.778911],
    ['latitude' => 47.646197, 'longitude' => -2.780220],
    ['latitude' => 47.646992, 'longitude' => -2.781068],
    ['latitude' => 47.647867, 'longitude' => -2.781744],
    ['latitude' => 47.648510, 'longitude' => -2.780145]
];



$distTotale = $classCalc->calculDistanceTrajet($parcours);
echo $distTotale;
?>