class Bien {
    constructor(nom, type) {
        this.nom = nom;
        this.type = type;
        this.etat = "DISPONIBLE";
    }

    estDisponible() {
        return this.etat === "DISPONIBLE";
    }

    reserver() {
        if (!this.estDisponible()) {
            throw new Error(`Le ${this.type} '${this.nom}' est déjà réservé.`);
        }
        this.etat = "RESERVEE";
    }

    annulerReservation() {
        if (this.estDisponible()) {
            throw new Error(`Le ${this.type} '${this.nom}' n'est pas réservé.`);
        }
        this.etat = "DISPONIBLE";
    }

    toString() {
        const capitalizedType = this.type.charAt(0).toUpperCase() + this.type.slice(1);
        return `${capitalizedType}{nom='${this.nom}', etat=${this.etat}}`;
    }
}

class LocationService {
    constructor(biens) {
        this.biens = {};
        biens.forEach(b => this.biens[b.nom] = b);
    }

    reserverBien(nom) {
        const bien = this.getBien(nom, false);
        bien.reserver();
    }

    annulerReservation(nom) {
        const bien = this.getBien(nom, true);
        bien.annulerReservation();
        console.log("✔️ Annulation de réservation avec succès");
    }

    afficherTousLesBiens() {
        console.log("\nListe des biens :");
        Object.values(this.biens).forEach(b => console.log(b.toString()));
    }

    afficherBiensDisponibles() {
        console.log("\nBiens disponibles :");
        Object.values(this.biens).filter(b => b.estDisponible()).forEach(b => console.log(b.toString()));
    }

    getBien(nom, pourAnnulation) {
        const bien = this.biens[nom];
        if (!bien) {
            throw new Error(pourAnnulation
                ? "Vous avez annulé une réservation d’un bien qui n'existe pas."
                : `Le bien '${nom}' n'existe pas.`);
        }
        return bien;
    }
}

// Test
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

executer(() => service.reserverBien("Maison_Tana"));
executer(() => service.reserverBien("Toyota123"));
executer(() => service.reserverBien("YamahaX"));

executer(() => service.reserverBien("Maison_Tana"));
executer(() => service.reserverBien("Toyota123"));
executer(() => service.reserverBien("YamahaX"));

executer(() => service.annulerReservation("Maison_Tana"));
executer(() => service.annulerReservation("Toyota123"));
executer(() => service.annulerReservation("YamahaX"));

executer(() => service.annulerReservation("Inconnu"));
executer(() => service.annulerReservation("Daba"));
executer(() => service.annulerReservation("Vaika"));


service.afficherTousLesBiens();
service.afficherBiensDisponibles();