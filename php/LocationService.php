<?php

require_once 'Bien.php';

class LocationService {
    private array $biens;

    public function __construct(array $biens) {
        $this->biens = [];
        foreach ($biens as $bien) {
            $this->biens[$bien->getNom()] = $bien;
        }
    }

    public function reserverBien(string $nom, int $dureeJours) {
        $bien = $this->getBien($nom, false);
        $bien->reserver($dureeJours);
    }

    public function annulerReservation(string $nom) {
        $bien = $this->getBien($nom, true);
        $bien->annulerReservation();
        echo "✔️ Annulation de réservation avec succès\n";
    }

    public function afficherTousLesBiens() {
        echo "\nListe des biens :\n";
        foreach ($this->biens as $bien) {
            echo $bien . "\n";
        }
    }

    public function afficherBiensDisponibles() {
        echo "\nBiens disponibles :\n";
        foreach ($this->biens as $bien) {
            if ($bien->estDisponible()) {
                echo $bien . "\n";
            }
        }
    }

    private function getBien(string $nom, bool $pourAnnulation): Bien {
        if (!isset($this->biens[$nom])) {
            throw new Exception($pourAnnulation
                ? "Vous avez annulé une réservation d’un bien qui n'existe pas."
                : "Le bien '{$nom}' n'existe pas.");
        }
        return $this->biens[$nom];
    }
}
