from datetime import datetime, timedelta

class Bien:
    def __init__(self, nom: str, type_: str):
        self.nom = nom
        self.type = type_
        self.etat = "DISPONIBLE"
        self.date_fin_reservation = None

    def est_disponible(self) -> bool:
        self.mettre_a_jour_etat()
        return self.etat == "DISPONIBLE"

    def reserver(self, duree_jours: int):
        if duree_jours < 1:
            raise ValueError("La durée minimale de réservation est d’au moins 1 jour.")
        if not self.est_disponible():
            raise Exception(f"Le {self.type} '{self.nom}' est déjà réservé.")
        self.etat = "RESERVEE"
        self.date_fin_reservation = datetime.now() + timedelta(days=duree_jours)

    def annuler_reservation(self):
        if self.est_disponible():
            raise Exception(f"Le {self.type} '{self.nom}' n’est pas réservé.")
        self.etat = "DISPONIBLE"
        self.date_fin_reservation = None

    def mettre_a_jour_etat(self):
        if self.etat == "RESERVEE" and self.date_fin_reservation and datetime.now() > self.date_fin_reservation:
            self.etat = "DISPONIBLE"
            self.date_fin_reservation = None

    def __str__(self):
        self.mettre_a_jour_etat()
        date_str = f" jusqu’au {self.date_fin_reservation.date()}" if self.date_fin_reservation else ""
        return f"{self.type.capitalize()}{{nom='{self.nom}', etat={self.etat}{date_str}}}"
