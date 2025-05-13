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

class LocationService {
    private array $biens;

    public function __construct(array $biens) {
        $this->biens = [];
        foreach ($biens as $bien) {
            $this->biens[$bien->getNom()] = $bien;
        }
    }

    public function reserverBien(string $nom) {
        $bien = $this->getBien($nom, false);
        $bien->reserver();
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
function executer(callable $action) {
    try {
        $action();
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}
?>
