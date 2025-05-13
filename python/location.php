class Bien:
    def __init__(self, nom, type_):
        self.nom = nom
        self.type = type_
        self.etat = "DISPONIBLE"

    def est_disponible(self):
        return self.etat == "DISPONIBLE"

    def reserver(self):
        if not self.est_disponible():
            raise Exception(f"Le {self.type} '{self.nom}' est déjà réservé.")
        self.etat = "RESERVEE"

    def annuler_reservation(self):
        if self.est_disponible():
            raise Exception(f"Le {self.type} '{self.nom}' n'est pas réservé.")
        self.etat = "DISPONIBLE"

    def __str__(self):
        return f"{self.type.capitalize()}{{nom='{self.nom}', etat={self.etat}}}"

