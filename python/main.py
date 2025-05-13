from bien import Bien
from location_service import LocationService

def executer(action):
    try:
        action()
    except Exception as e:
        print(e)

biens = [
    Bien("Maison_Tana", "maison"),
    Bien("Toyota123", "voiture"),
    Bien("YamahaX", "moto")
]

service = LocationService(biens)

service.afficher_tous_les_biens()

executer(lambda: service.reserver_bien("Maison_Tana", 2))
executer(lambda: service.reserver_bien("Toyota123", 1))
executer(lambda: service.reserver_bien("YamahaX", 3))

executer(lambda: service.reserver_bien("Maison_Tana", 1))
executer(lambda: service.annuler_reservation("Toyota123"))
executer(lambda: service.annuler_reservation("YamahaX"))
executer(lambda: service.annuler_reservation("Maison_Tana"))

executer(lambda: service.reserver_bien("Inconnu", 2))
executer(lambda: service.reserver_bien("Vaika", 1))

service.afficher_tous_les_biens()
service.afficher_biens_disponibles()
