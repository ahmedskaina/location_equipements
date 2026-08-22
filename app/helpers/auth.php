<?php

function requireLogin(): void
{
    if (!isset($_SESSION['utilisateur'])) {
        header('Location: index.php?action=login');
        exit;
    }
}


function requireRole(array $rolesAutorises): void
{
    requireLogin();

    $roleUtilisateur =
        $_SESSION['utilisateur']['role'] ?? '';

    if (!in_array(
        $roleUtilisateur,
        $rolesAutorises,
        true
    )) {
        http_response_code(403);

        die("Accès interdit.");
    }
}