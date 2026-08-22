<?php

require_once __DIR__ . '/../models/Utilisateur.php';

class AuthController
{
    private Utilisateur $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Utilisateur($pdo);
    }

    public function login(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $motDePasse = $_POST['mot_de_passe'] ?? '';

            if ($email === '') {
                $errors[] = "L'email est obligatoire.";
            }

            if ($motDePasse === '') {
                $errors[] = "Le mot de passe est obligatoire.";
            }

            if (empty($errors)) {

                $utilisateur =
                    $this->model->findByEmail($email);

                if (
                    !$utilisateur
                    ||
                    !password_verify(
                        $motDePasse,
                        $utilisateur['mot_de_passe']
                    )
                ) {
                    $errors[] =
                        "Email ou mot de passe incorrect.";
                }
            }

            if (empty($errors)) {

                $_SESSION['utilisateur'] = [
                    'id' => $utilisateur['id_utilisateur'],
                    'nom' => $utilisateur['nom'],
                    'prenom' => $utilisateur['prenom'],
                    'email' => $utilisateur['email'],
                    'role' => $utilisateur['role']
                ];

               $role = $utilisateur['role'];

if (
    $role === 'RESPONSABLE_INVENTAIRE'
    ||
    $role === 'AGENT_LOCATION'
) {

    header(
        'Location: index.php?action=dashboard'
    );

} else {

    header(
        'Location: index.php?action=client-home'
    );
}

exit;
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();

        header(
            'Location: index.php?action=login'
        );

        exit;
    }
}