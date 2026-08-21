<?php

require_once __DIR__ . '/../models/Equipement.php';

class EquipementController
{
    private Equipement $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Equipement($pdo);
    }

    public function index(): void
    {
        $equipements = $this->model->getAll();

        require __DIR__ . '/../views/equipements/index.php';
    }
    public function create(): void
{
    $categories = $this->model->getCategories();

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nom = trim($_POST['nom'] ?? '');
        $reference = trim($_POST['reference'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $prixJournalier = (float) ($_POST['prix_journalier'] ?? 0);
        $quantiteStock = (int) ($_POST['quantite_stock'] ?? -1);
        $seuilAlerte = (int) ($_POST['seuil_alerte'] ?? -1);

        $etat = $_POST['etat'] ?? '';
        $idCategorie = (int) ($_POST['id_categorie'] ?? 0);

        if ($nom === '') {
            $errors[] = "Le nom est obligatoire.";
        }

        if ($reference === '') {
            $errors[] = "La référence est obligatoire.";
        }

        if ($prixJournalier <= 0) {
            $errors[] = "Le prix journalier doit être supérieur à 0.";
        }

        if ($quantiteStock < 0) {
            $errors[] = "La quantité en stock ne peut pas être négative.";
        }

        if ($seuilAlerte < 0) {
            $errors[] = "Le seuil d'alerte ne peut pas être négatif.";
        }

        $etatsAutorises = [
            'DISPONIBLE',
            'EN_LOCATION',
            'EN_MAINTENANCE',
            'ENDOMMAGE'
        ];

        if (!in_array($etat, $etatsAutorises, true)) {
            $errors[] = "L'état sélectionné est invalide.";
        }

        if ($idCategorie <= 0) {
            $errors[] = "Veuillez sélectionner une catégorie.";
        }
        $imageName = null;

if (
    isset($_FILES['image']) &&
    $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
) {

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {

        $errors[] = "Erreur lors de l'envoi de l'image.";

    } else {

        $extensionsAutorisees = [
            'jpg',
            'jpeg',
            'png'
        ];

        $extension = strtolower(
            pathinfo(
                $_FILES['image']['name'],
                PATHINFO_EXTENSION
            )
        );

        if (!in_array($extension, $extensionsAutorisees, true)) {

            $errors[] =
                "L'image doit être au format JPG, JPEG ou PNG.";
        }

        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {

            $errors[] =
                "L'image ne doit pas dépasser 2 Mo.";
        }

        if (empty($errors)) {

            $imageName =
                uniqid('equipement_', true)
                . '.'
                . $extension;

            $destination =
                __DIR__
                . '/../../public/images/'
                . $imageName;

            if (
                !move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    $destination
                )
            ) {
                $errors[] =
                    "Impossible d'enregistrer l'image.";
            }
        }
    }
}

        if (empty($errors)) {

            $this->model->create(
                $nom,
                $reference,
                $description,
                $prixJournalier,
                $quantiteStock,
                $seuilAlerte,
                $etat,
                $imageName,
                $idCategorie
            );

            header('Location: index.php?action=equipements');
            exit;
        }
    }

    require __DIR__ . '/../views/equipements/create.php';
}
public function edit(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $equipement = $this->model->getById($id);

    if (!$equipement) {
        die("Équipement introuvable.");
    }

    $categories = $this->model->getCategories();

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nom = trim($_POST['nom'] ?? '');
        $reference = trim($_POST['reference'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $prixJournalier =
            (float) ($_POST['prix_journalier'] ?? 0);

        $quantiteStock =
            (int) ($_POST['quantite_stock'] ?? -1);

        $seuilAlerte =
            (int) ($_POST['seuil_alerte'] ?? -1);

        $etat = $_POST['etat'] ?? '';

        $idCategorie =
            (int) ($_POST['id_categorie'] ?? 0);


        // Contrôles de saisie

        if ($nom === '') {
            $errors[] = "Le nom est obligatoire.";
        }

        if ($reference === '') {
            $errors[] = "La référence est obligatoire.";
        }

        if ($prixJournalier <= 0) {
            $errors[] =
                "Le prix journalier doit être supérieur à 0.";
        }

        if ($quantiteStock < 0) {
            $errors[] =
                "La quantité en stock ne peut pas être négative.";
        }

        if ($seuilAlerte < 0) {
            $errors[] =
                "Le seuil d'alerte ne peut pas être négatif.";
        }

        $etatsAutorises = [
            'DISPONIBLE',
            'EN_LOCATION',
            'EN_MAINTENANCE',
            'ENDOMMAGE'
        ];

        if (!in_array($etat, $etatsAutorises, true)) {
            $errors[] = "L'état sélectionné est invalide.";
        }

        if ($idCategorie <= 0) {
            $errors[] =
                "Veuillez sélectionner une catégorie.";
        }


        // Si aucune erreur

        if (empty($errors)) {

            $this->model->update(
                $id,
                $nom,
                $reference,
                $description,
                $prixJournalier,
                $quantiteStock,
                $seuilAlerte,
                $etat,
                $idCategorie
            );

            header(
                'Location: index.php?action=equipements'
            );

            exit;
        }


        // Garder les nouvelles valeurs si erreur

        $equipement['nom'] = $nom;
        $equipement['reference'] = $reference;
        $equipement['description'] = $description;
        $equipement['prix_journalier'] = $prixJournalier;
        $equipement['quantite_stock'] = $quantiteStock;
        $equipement['seuil_alerte'] = $seuilAlerte;
        $equipement['etat'] = $etat;
        $equipement['id_categorie'] = $idCategorie;
    }

    require __DIR__ . '/../views/equipements/edit.php';
}
public function delete(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $equipement = $this->model->getById($id);

    if (!$equipement) {
        die("Équipement introuvable.");
    }

    try {

        // Suppression de l'équipement dans la base
        $this->model->delete($id);

        // Suppression de l'image physique
        if (!empty($equipement['image'])) {

            $imagesDirectory =
    realpath(__DIR__ . '/../../public/images');

$imagePath =
    $imagesDirectory
    . DIRECTORY_SEPARATOR
    . basename($equipement['image']);

if (file_exists($imagePath)) {
    unlink($imagePath);
}
        }

        header('Location: index.php?action=equipements');
        exit;

    } catch (PDOException $e) {

        die(
            "Impossible de supprimer cet équipement. "
            . "Il est peut-être associé à une location."
        );
    }
}
public function alerts(): void
{
    $equipements = $this->model->getStocksFaibles();

    require __DIR__
        . '/../views/equipements/alerts.php';
}
public function search(): void
{
    $categories = $this->model->getCategories();

    $nom = trim($_GET['nom'] ?? '');

    $idCategorie =
        (int) ($_GET['id_categorie'] ?? 0);

    $etat =
        $_GET['etat'] ?? '';

    $prixMax = null;

    if (
        isset($_GET['prix_max'])
        && $_GET['prix_max'] !== ''
    ) {
        $prixMax =
            (float) $_GET['prix_max'];
    }

    $stockDisponible =
        isset($_GET['stock_disponible'])
        && $_GET['stock_disponible'] === '1';


    $equipements = $this->model->search(
        $nom,
        $idCategorie,
        $etat,
        $prixMax,
        $stockDisponible
    );

    require __DIR__
        . '/../views/equipements/search.php';
}
}
