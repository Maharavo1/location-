<?php

require_once 'LocationService.php';

$biens = [
    new Bien("Maison_Tana", "maison"),
    new Bien("Toyota123", "voiture"),
    new Bien("YamahaX", "moto"),
];

$service = new LocationService($biens);

function executer(callable $action) {
    try {
        $action();
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}

$service->afficherTousLesBiens();

executer(fn() => $service->reserverBien("Maison_Tana", 2));
executer(fn() => $service->reserverBien("Toyota123", 1));
executer(fn() => $service->reserverBien("YamahaX", 3));

executer(fn() => $service->reserverBien("Maison_Tana", 1));
executer(fn() => $service->annulerReservation("Toyota123"));
executer(fn() => $service->annulerReservation("YamahaX"));
executer(fn() => $service->annulerReservation("Maison_Tana"));

executer(fn() => $service->reserverBien("Inconnu", 2));
executer(fn() => $service->reserverBien("Vaika", 1));

$service->afficherTousLesBiens();
$service->afficherBiensDisponibles();
