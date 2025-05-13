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

