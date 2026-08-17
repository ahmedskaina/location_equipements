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
public function edit(): void
{
    $id = (int) ($_GET['id'] ?? 0);

    if ($id <= 0) {
        die("Identifiant invalide.");
    }

    $utilisateur = $this->model->getById($id);

    if (!$utilisateur) {
        die("Utilisateur introuvable.");
    }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
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

        } elseif (
            $this->model->emailExistsForOtherUser(
                $email,
                $id
            )
        ) {

            $errors[] = "Cet email est déjà utilisé.";
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

            $this->model->update(
                $id,
                $nom,
                $prenom,
                $email,
                $telephone,
                $role
            );

            header(
                'Location: index.php?action=utilisateurs'
            );

            exit;
        }

        $utilisateur['nom'] = $nom;
        $utilisateur['prenom'] = $prenom;
        $utilisateur['email'] = $email;
        $utilisateur['telephone'] = $telephone;
        $utilisateur['role'] = $role;
    }

    require __DIR__ . '/../views/utilisateurs/edit.php';
}
}