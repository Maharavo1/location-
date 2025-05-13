import { Bien } from './Bien.js';

export class LocationService {
    constructor(biens) {
        this.biens = {};
        biens.forEach(b => this.biens[b.nom] = b);
    }

    reserverBien(nom, dureeJours) {
        const bien = this.getBien(nom, false);
        bien.reserver(dureeJours);
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
        Object.values(this.biens)
            .filter(b => b.estDisponible())
            .forEach(b => console.log(b.toString()));
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
