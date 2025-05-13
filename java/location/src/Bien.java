import java.time.LocalDate;

public class Bien {
    private final String nom;
    private final String type;
    private Etat etat;
    private LocalDate dateFinReservation;

    public Bien(String nom, String type) {
        this.nom = nom;
        this.type = type;
        this.etat = Etat.DISPONIBLE;
        this.dateFinReservation = null;
    }

    public String getNom() {
        return nom;
    }

    public String getType() {
        return type;
    }

    public Etat getEtat() {
        mettreAJourEtat();
        return etat;
    }

    public boolean estDisponible() {
        mettreAJourEtat();
        return etat == Etat.DISPONIBLE;
    }

    public void reserver(int dureeJours) {
        if (dureeJours < 1) {
            throw new IllegalArgumentException("La durée minimale de réservation est d'au moins 1 jour.");
        }
        if (!estDisponible()) {
            throw new IllegalStateException("Le " + type + " '" + nom + "' est déjà réservé.");
        }
        this.etat = Etat.RESERVEE;
        this.dateFinReservation = LocalDate.now().plusDays(dureeJours);
    }

    public void annulerReservation() {
        if (estDisponible()) {
            throw new IllegalStateException("Le " + type + " '" + nom + "' n'est pas réservé.");
        }
        this.etat = Etat.DISPONIBLE;
        this.dateFinReservation = null;
    }

    private void mettreAJourEtat() {
        if (etat == Etat.RESERVEE && dateFinReservation != null && LocalDate.now().isAfter(dateFinReservation)) {
            etat = Etat.DISPONIBLE;
            dateFinReservation = null;
        }
    }

    @Override
    public String toString() {
        mettreAJourEtat();
        String dateInfo = (etat == Etat.RESERVEE && dateFinReservation != null)
                ? " jusqu’au " + dateFinReservation
                : "";
        return String.format("%s{nom='%s', etat=%s%s}",
                type.substring(0, 1).toUpperCase() + type.substring(1), nom, etat, dateInfo);
    }
}
