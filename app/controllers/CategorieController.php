<?php

require_once __DIR__ . '/../models/CategorieEquipement.php';

class CategorieController
{
    private CategorieEquipement $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new CategorieEquipement($pdo);
    }

    public function index(): void
    {
        $categories = $this->model->getAll();

        require __DIR__ . '/../views/categories/index.php';
    }

    public function create(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nom = trim($_POST['nom'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if ($nom === '') {
                $errors[] = "Le nom est obligatoire.";
            }

            if (strlen($nom) < 3) {
                $errors[] = "Le nom doit contenir au moins 3 caractères.";
            }

            if (empty($errors)) {
                $this->model->create($nom, $description);

                header('Location: index.php?action=categories');
                exit;
            }
        }

        require __DIR__ . '/../views/categories/create.php';
    }
    public function edit(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    $categorie = $this->model->getById($id);

    if (!$categorie) {
        die("Catégorie introuvable.");
    }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nom = trim($_POST['nom'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($nom === '') {
            $errors[] = "Le nom est obligatoire.";
        }

        if (strlen($nom) < 3) {
            $errors[] = "Le nom doit contenir au moins 3 caractères.";
        }

        if (empty($errors)) {

            $this->model->update(
                $id,
                $nom,
                $description
            );

            header('Location: index.php?action=categories');
            exit;
        }

        $categorie['nom'] = $nom;
        $categorie['description'] = $description;
    }

    require __DIR__ . '/../views/categories/edit.php';
}
}