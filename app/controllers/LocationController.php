<?php

require_once __DIR__ . '/../models/Location.php';
require_once __DIR__ . '/../models/Equipement.php';

class LocationController
{
    private Location $model;
    private Equipement $equipementModel;

    public function __construct(PDO $pdo)
    {
        $this->model = new Location($pdo);
        $this->equipementModel = new Equipement($pdo);

    }

    public function index(): void
    {
        $locations = $this->model->getAll();

        require __DIR__ . '/../views/locations/index.php';
    }
    public function create(): void
{
    $clients = $this->model->getClients();
    $equipements = $this->model->getEquipements();

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $idClient = (int) ($_POST['id_client'] ?? 0);
        $idEquipement = (int) ($_POST['id_equipement'] ?? 0);

        $dateDebut = $_POST['date_debut'] ?? '';
        $dateFin = $_POST['date_fin'] ?? '';

        $quantite = (int) ($_POST['quantite'] ?? 0);

        if ($idClient <= 0) {
            $errors[] = "Veuillez sélectionner un client.";
        }

        if ($idEquipement <= 0) {
            $errors[] = "Veuillez sélectionner un équipement.";
        }

        if ($dateDebut === '') {
            $errors[] = "La date de début est obligatoire.";
        }

        if ($dateFin === '') {
            $errors[] = "La date de fin est obligatoire.";
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
            $errors[] = "La quantité doit être supérieure à 0.";
        }

        $equipement = false;

        if ($idEquipement > 0) {
            $equipement =
                $this->model->getEquipementById($idEquipement);

            if (!$equipement) {
                $errors[] = "Équipement introuvable.";
            }
        }

        if ($equipement) {

            if ($equipement['etat'] !== 'DISPONIBLE') {
                $errors[] =
                    "Cet équipement n'est pas disponible.";
            }

           if (
    $equipement
    && $dateDebut !== ''
    && $dateFin !== ''
    && $dateFin >= $dateDebut
    && $quantite > 0
) {

    $quantiteReservee =
        $this->model->getQuantiteReservee(
            $idEquipement,
            $dateDebut,
            $dateFin
        );

    $stockTotal =
        (int) $equipement['quantite_stock'];

    $stockDisponible =
        $stockTotal - $quantiteReservee;

    if ($quantite > $stockDisponible) {

        $errors[] =
            "Stock insuffisant pour cette période. "
            . "Quantité disponible : "
            . $stockDisponible
            . ".";
    }
}
        }

        if (empty($errors)) {

            $debut = new DateTime($dateDebut);
            $fin = new DateTime($dateFin);

            $difference = $debut->diff($fin);

            $duree = $difference->days + 1;

            $prixJournalier =
                (float) $equipement['prix_journalier'];

            $prixTotal =
                $prixJournalier
                * $quantite
                * $duree;

            $this->model->create(
                $dateDebut,
                $dateFin,
                $duree,
                $quantite,
                $prixTotal,
                $idClient,
                $idEquipement
            );

            header(
                'Location: index.php?action=locations'
            );

            exit;
        }
    }

    require __DIR__ . '/../views/locations/create.php';
}
public function validate(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $location = $this->model->getById($id);

    if (!$location) {
        die("Location introuvable.");
    }

    if ($location['statut'] !== 'EN_ATTENTE') {
        die(
            "Seules les demandes en attente "
            . "peuvent être validées."
        );
    }

    $this->model->updateStatut(
        $id,
        'VALIDEE'
    );

    header(
        'Location: index.php?action=locations'
    );

    exit;
}
public function refuse(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $location = $this->model->getById($id);

    if (!$location) {
        die("Location introuvable.");
    }

    if ($location['statut'] !== 'EN_ATTENTE') {
        die(
            "Seules les demandes en attente "
            . "peuvent être refusées."
        );
    }

    $this->model->updateStatut(
        $id,
        'REFUSEE'
    );

    header(
        'Location: index.php?action=locations'
    );

    exit;
}
public function start(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $location = $this->model->getById($id);

    if (!$location) {
        die("Location introuvable.");
    }

    if ($location['statut'] !== 'VALIDEE') {
        die(
            "Seule une location validée "
            . "peut être démarrée."
        );
    }

    $this->model->updateStatut(
        $id,
        'EN_COURS'
    );

    $this->equipementModel->updateEtat(
        (int) $location['id_equipement'],
        'EN_LOCATION'
    );

    header(
        'Location: index.php?action=locations'
    );

    exit;
}
public function returnEquipment(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $location = $this->model->getById($id);

    if (!$location) {
        die("Location introuvable.");
    }

    if ($location['statut'] !== 'EN_COURS') {
        die(
            "Seule une location en cours "
            . "peut être retournée."
        );
    }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $etatRetour = $_POST['etat_retour'] ?? '';

        $etatsAutorises = [
            'DISPONIBLE',
            'EN_MAINTENANCE',
            'ENDOMMAGE'
        ];

        if (!in_array($etatRetour, $etatsAutorises, true)) {
            $errors[] = "L'état de retour est invalide.";
        }

        if (empty($errors)) {

            $this->model->updateStatut(
                $id,
                'TERMINEE'
            );

            $this->equipementModel->updateEtat(
                (int) $location['id_equipement'],
                $etatRetour
            );

            header(
                'Location: index.php?action=locations'
            );

            exit;
        }
    }

    require __DIR__ . '/../views/locations/return.php';
}
}