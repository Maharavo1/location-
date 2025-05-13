<?php

class Bien {
    private string $nom;
    private string $type;
    private string $etat;

    public function __construct(string $nom, string $type) {
        $this->nom = $nom;
        $this->type = $type;
        $this->etat = "DISPONIBLE";
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function estDisponible(): bool {
        return $this->etat === "DISPONIBLE";
    }

    public function reserver() {
        if (!$this->estDisponible()) {
            throw new Exception("Le {$this->type} '{$this->nom}' est déjà réservé.");
        }
        $this->etat = "RESERVEE";
    }

    public function annulerReservation() {
        if ($this->estDisponible()) {
            throw new Exception("Le {$this->type} '{$this->nom}' n'est pas réservé.");
        }
        $this->etat = "DISPONIBLE";
    }

    public function __toString(): string {
        return ucfirst($this->type) . "{nom='{$this->nom}', etat={$this->etat}}";
    }
}


?>
