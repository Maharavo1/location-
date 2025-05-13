from bien import Bien

class LocationService:
    def __init__(self, biens: list[Bien]):
        self.biens = {bien.nom: bien for bien in biens}

    def reserver_bien(self, nom: str, duree_jours: int):
        bien = self._get_bien(nom, pour_annulation=False)
        bien.reserver(duree_jours)

    def annuler_reservation(self, nom: str):
        bien = self._get_bien(nom, pour_annulation=True)
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

    def _get_bien(self, nom: str, pour_annulation: bool) -> Bien:
        if nom not in self.biens:
            raise Exception("Vous avez annulé une réservation d’un bien qui n'existe pas." if pour_annulation else f"Le bien '{nom}' n'existe pas.")
        return self.biens[nom]
