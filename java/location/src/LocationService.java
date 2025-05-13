import java.util.*;

public class LocationService {
    private final Map<String, Bien> biens;

    public LocationService(List<Bien> listeBiens) {
        this.biens = new HashMap<>();
        for (Bien bien : listeBiens) {
            biens.put(bien.getNom(), bien);
        }
    }

    public void reserverBien(String nom, int dureeJours) {
        Bien bien = getBien(nom, false);
        bien.reserver(dureeJours);
    }

    public void annulerReservation(String nom) {
        Bien bien = getBien(nom, true);
        bien.annulerReservation();
        System.out.println("✔️ Annulation de réservation avec succès");
    }

    public void afficherTousLesBiens() {
        System.out.println("\nListe des biens :");
        biens.values().forEach(System.out::println);
    }

    public void afficherBiensDisponibles() {
        System.out.println("\nBiens disponibles :");
        biens.values().stream()
                .filter(Bien::estDisponible)
                .forEach(System.out::println);
    }

    private Bien getBien(String nom, boolean pourAnnulation) {
        Bien bien = biens.get(nom);
        if (bien == null) {
            if (pourAnnulation) {
                throw new NoSuchElementException("Vous avez annulé une réservation d’un bien qui n'existe pas.");
            } else {
                throw new NoSuchElementException("Le bien '" + nom + "' n'existe pas.");
            }
        }
        return bien;
    }
}
