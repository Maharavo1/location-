import { Bien } from './Bien.js';
import { LocationService } from './LocationService.js';

const biens = [
    new Bien("Maison_Tana", "maison"),
    new Bien("Toyota123", "voiture"),
    new Bien("YamahaX", "moto"),
];

const service = new LocationService(biens);

function executer(action) {
    try {
        action();
    } catch (e) {
        console.error(e.message);
    }
}

service.afficherTousLesBiens();

executer(() => service.reserverBien("Maison_Tana", 2));
executer(() => service.reserverBien("Toyota123", 1));
executer(() => service.reserverBien("YamahaX", 3));

executer(() => service.reserverBien("Maison_Tana", 1));
executer(() => service.annulerReservation("Toyota123"));
executer(() => service.annulerReservation("YamahaX"));
executer(() => service.annulerReservation("Maison_Tana"));

executer(() => service.reserverBien("Inconnu", 2));
executer(() => service.reserverBien("Vaika", 1));

service.afficherTousLesBiens();
service.afficherBiensDisponibles();
