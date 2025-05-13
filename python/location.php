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


class LocationService:
    def __init__(self, biens):
        self.biens = {b.nom: b for b in biens}

    def reserver_bien(self, nom):
        bien = self._get_bien(nom, False)
        bien.reserver()

    def annuler_reservation(self, nom):
        bien = self._get_bien(nom, True)
        bien.annuler_reservation()
        print("✔️ Annulation de réservation avec succès")

    def afficher_tous_les_biens(self):
        print("\nListe des biens :")
        for bien in self.biens.values():
            print(bien)

    def afficher_biens_disponibles(self):
        print("\nBiens disponibles :")
        for bien in self.biens.values():
            if bien.est_disponible():
                print(bien)

    def _get_bien(self, nom, pour_annulation):
        bien = self.biens.get(nom)
        if not bien:
            if pour_annulation:
                raise Exception("Vous avez annulé une réservation d’un bien qui n'existe pas.")
            else:
                raise Exception(f"Le bien '{nom}' n'existe pas.")
        return bien

