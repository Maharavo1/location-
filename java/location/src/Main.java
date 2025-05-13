import java.util.List;

public class Main {
    public static void main(String[] args) {

        List<Bien> biensConnus = List.of(
                new Bien("Maison_Tana", "maison"),
                new Bien("Toyota123", "voiture"),
                new Bien("YamahaX", "moto")
        );

        LocationService service = new LocationService(biensConnus);

        service.afficherTousLesBiens();

        executer(() -> service.reserverBien("Maison_Tana"));
        executer(() -> service.reserverBien("Toyota123"));
        executer(() -> service.reserverBien("YamahaX"));

        executer(() -> service.reserverBien("Maison_Tana"));
        executer(() -> service.reserverBien("Toyota123"));
        executer(() -> service.reserverBien("YamahaX"));


        executer(() -> service.annulerReservation("Maison_Tana"));
        executer(() -> service.annulerReservation("Toyota123"));
        executer(() -> service.annulerReservation("YamahaX"));


        executer(() -> service.reserverBien("inconnu"));
        executer(() -> service.reserverBien("motors"));
        executer(() -> service.reserverBien("trano"));

        service.afficherTousLesBiens();
        service.afficherBiensDisponibles();
    }

    private static void executer(Runnable action) {
        try {
            action.run();
        } catch (Exception e) {
            System.err.println(e.getMessage());
        }
    }

}
