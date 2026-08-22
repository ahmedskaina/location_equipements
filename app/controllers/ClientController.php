<?php

require_once __DIR__ . '/../models/Equipement.php';
require_once __DIR__ . '/../models/Location.php';
class ClientController
{
    private Equipement $equipementModel;
    private Location $locationModel;

    public function __construct(PDO $pdo)
    {
        $this->equipementModel = new Equipement($pdo);
        $this->locationModel = new Location($pdo);

    }

    public function home(): void
    {
        $equipements =
            $this->equipementModel->getDisponibles();

        require __DIR__ . '/../views/client/home.php';
    }
    public function createLocation(): void
{
    $idEquipement = (int) ($_GET['id'] ?? 0);

    if ($idEquipement <= 0) {
        die("Identifiant équipement invalide.");
    }

    $equipement =
        $this->locationModel->getEquipementById($idEquipement);

    if (!$equipement) {
        die("Équipement introuvable.");
    }

    if ($equipement['etat'] !== 'DISPONIBLE') {
        die("Cet équipement n'est pas disponible.");
    }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $dateDebut =
            $_POST['date_debut'] ?? '';

        $dateFin =
            $_POST['date_fin'] ?? '';

        $quantite =
            (int) ($_POST['quantite'] ?? 0);

        if ($dateDebut === '') {
            $errors[] =
                "La date de début est obligatoire.";
        }

        if ($dateFin === '') {
            $errors[] =
                "La date de fin est obligatoire.";
        }

        if (
            $dateDebut !== ''
            && $dateFin !== ''
            && $dateFin < $dateDebut
        ) {
            $errors[] =
                "La date de fin doit être supérieure ou égale à la date de début.";
        }

        if ($quantite <= 0) {
            $errors[] =
                "La quantité doit être supérieure à 0.";
        }

        if (
            $dateDebut !== ''
            && $dateFin !== ''
            && $dateFin >= $dateDebut
            && $quantite > 0
        ) {

            $quantiteReservee =
                $this->locationModel->getQuantiteReservee(
                    $idEquipement,
                    $dateDebut,
                    $dateFin
                );

            $stockDisponible =
                (int) $equipement['quantite_stock']
                - $quantiteReservee;

            if ($quantite > $stockDisponible) {

                $errors[] =
                    "Stock insuffisant pour cette période. "
                    . "Quantité disponible : "
                    . $stockDisponible
                    . ".";
            }
        }

        if (empty($errors)) {

            $debut = new DateTime($dateDebut);
            $fin = new DateTime($dateFin);

            $difference = $debut->diff($fin);

            $duree =
                $difference->days + 1;

            $prixTotal =
                (float) $equipement['prix_journalier']
                * $quantite
                * $duree;

            $idClient =
                (int) $_SESSION['utilisateur']['id'];

            $this->locationModel->create(
                $dateDebut,
                $dateFin,
                $duree,
                $quantite,
                $prixTotal,
                $idClient,
                $idEquipement
            );

            header(
                'Location: index.php?action=client-my-locations'
            );

            exit;
        }
    }

    require __DIR__
        . '/../views/client/create-location.php';
}
public function myLocations(): void
{
    $idClient =
        (int) $_SESSION['utilisateur']['id'];

    $locations =
        $this->locationModel->getByClient($idClient);

    require __DIR__
        . '/../views/client/my-locations.php';
}
}