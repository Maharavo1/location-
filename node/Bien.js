export class Bien {
    constructor(nom, type) {
        this.nom = nom;
        this.type = type;
        this.etat = "DISPONIBLE";
        this.dateFinReservation = null;
    }

    estDisponible() {
        this.mettreAJourEtat();
        return this.etat === "DISPONIBLE";
    }

    reserver(dureeJours) {
        if (dureeJours < 1) {
            throw new Error("La durée minimale de réservation est d'au moins 1 jour.");
        }
        if (!this.estDisponible()) {
            throw new Error(`Le ${this.type} '${this.nom}' est déjà réservé.`);
        }
        this.etat = "RESERVEE";
        const aujourdHui = new Date();
        this.dateFinReservation = new Date(aujourdHui.setDate(aujourdHui.getDate() + dureeJours));
    }

    annulerReservation() {
        if (this.estDisponible()) {
            throw new Error(`Le ${this.type} '${this.nom}' n'est pas réservé.`);
        }
        this.etat = "DISPONIBLE";
        this.dateFinReservation = null;
    }

    mettreAJourEtat() {
        if (this.etat === "RESERVEE" && this.dateFinReservation && new Date() > this.dateFinReservation) {
            this.etat = "DISPONIBLE";
            this.dateFinReservation = null;
        }
    }

    toString() {
        this.mettreAJourEtat();
        const dateStr = this.dateFinReservation ? ` jusqu’au ${this.dateFinReservation.toLocaleDateString()}` : '';
        const capitalized = this.type.charAt(0).toUpperCase() + this.type.slice(1);
        return `${capitalized}{nom='${this.nom}', etat=${this.etat}${dateStr}}`;
    }
}
