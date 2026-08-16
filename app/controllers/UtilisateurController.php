<?php

require_once __DIR__ . '/../models/Utilisateur.php';

class UtilisateurController
{
    private Utilisateur $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Utilisateur($pdo);
    }

    public function index(): void
    {
        $utilisateurs = $this->model->getAll();

        require __DIR__ . '/../views/utilisateurs/index.php';
    }
    public function create(): void
{
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';
        $role = $_POST['role'] ?? '';

        if ($nom === '') {
            $errors[] = "Le nom est obligatoire.";
        }

        if ($prenom === '') {
            $errors[] = "Le prénom est obligatoire.";
        }

        if ($email === '') {
            $errors[] = "L'email est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email est invalide.";
        } elseif ($this->model->emailExists($email)) {
            $errors[] = "Cet email est déjà utilisé.";
        }

        if (strlen($motDePasse) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        $rolesAutorises = [
            'CLIENT',
            'AGENT_LOCATION',
            'RESPONSABLE_INVENTAIRE'
        ];

        if (!in_array($role, $rolesAutorises, true)) {
            $errors[] = "Le rôle sélectionné est invalide.";
        }

        if (empty($errors)) {

            $motDePasseHash = password_hash(
                $motDePasse,
                PASSWORD_DEFAULT
            );

            $this->model->create(
                $nom,
                $prenom,
                $email,
                $motDePasseHash,
                $telephone,
                $role
            );

            header('Location: index.php?action=utilisateurs');
            exit;
        }
    }

    require __DIR__ . '/../views/utilisateurs/create.php';
}
}