public class Bien {
    private final String nom;
    private final String type;
    private Etat etat;

    public Bien(String nom, String type) {
        this.nom = nom;
        this.type = type;
        this.etat = Etat.DISPONIBLE;
    }

    public String getNom() {
        return nom;
    }

    public String getType() {
        return type;
    }

    public Etat getEtat() {
        return etat;
    }

    public boolean estDisponible() {
        return etat == Etat.DISPONIBLE;
    }

    public void reserver() {
        if (!estDisponible()) {
            throw new IllegalStateException("Le " + type + " '" + nom + "' est déjà réservé.");
        }
        this.etat = Etat.RESERVEE;
    }

    public void annulerReservation() {
        if (estDisponible()) {
            throw new IllegalStateException("Le " + type + " '" + nom + "' n'est pas réservé.");
        }
        this.etat = Etat.DISPONIBLE;
    }

    @Override
    public String toString() {
        return String.format("%s{nom='%s', etat=%s}", type.substring(0, 1).toUpperCase() + type.substring(1), nom, etat);
    }
}
