<?php

class Bien {
    private string $nom;
    private string $type;
    private string $etat;
    private ?DateTime $dateFinReservation;

    public function __construct(string $nom, string $type) {
        $this->nom = $nom;
        $this->type = $type;
        $this->etat = "DISPONIBLE";
        $this->dateFinReservation = null;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function estDisponible(): bool {
        $this->mettreAJourEtat();
        return $this->etat === "DISPONIBLE";
    }

    public function reserver(int $dureeJours) {
        if ($dureeJours < 1) {
            throw new Exception("La durée minimale de réservation est d'au moins 1 jour.");
        }
        if (!$this->estDisponible()) {
            throw new Exception("Le {$this->type} '{$this->nom}' est déjà réservé.");
        }
        $this->etat = "RESERVEE";
        $this->dateFinReservation = (new DateTime())->modify("+{$dureeJours} days");
    }

    public function annulerReservation() {
        if ($this->estDisponible()) {
            throw new Exception("Le {$this->type} '{$this->nom}' n'est pas réservé.");
        }
        $this->etat = "DISPONIBLE";
        $this->dateFinReservation = null;
    }

    private function mettreAJourEtat() {
        if ($this->etat === "RESERVEE" && $this->dateFinReservation && new DateTime() > $this->dateFinReservation) {
            $this->etat = "DISPONIBLE";
            $this->dateFinReservation = null;
        }
    }

    public function __toString(): string {
        $this->mettreAJourEtat();
        $dateStr = ($this->etat === "RESERVEE" && $this->dateFinReservation)
            ? " jusqu’au " . $this->dateFinReservation->format('Y-m-d')
            : "";
        return ucfirst($this->type) . "{nom='{$this->nom}', etat={$this->etat}{$dateStr}}";
    }
}
