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

        if (empty($errors)) {

            $this->model->create(
                $nom,
                $reference,
                $description,
                $prixJournalier,
                $quantiteStock,
                $seuilAlerte,
                $etat,
                $idCategorie
            );

            header('Location: index.php?action=equipements');
            exit;
        }
    }

    require __DIR__ . '/../views/equipements/create.php';
}
}
?>