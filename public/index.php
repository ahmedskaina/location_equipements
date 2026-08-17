<?php

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../app/controllers/CategorieController.php';
require_once __DIR__ . '/../app/controllers/EquipementController.php';
require_once __DIR__ . '/../app/controllers/UtilisateurController.php';

$categorieController = new CategorieController($pdo);
$equipementController = new EquipementController($pdo);
$utilisateurController = new UtilisateurController($pdo);

$action = $_GET['action'] ?? 'categories';

switch ($action) {

    case 'categories':
        $categorieController->index();
        break;

    case 'create-category':
        $categorieController->create();
        break;

    case 'edit-category':
        $categorieController->edit();
        break;

    case 'delete-category':
        $categorieController->delete();
        break;

    case 'equipements':
        $equipementController->index();
        break;
    case 'create-equipement':
        $equipementController->create();
        break;
    case 'edit-equipement':
    $equipementController->edit();
    break;
    case 'delete-equipement':
    $equipementController->delete();
    break;
    case 'utilisateurs':
    $utilisateurController->index();
    break;
    case 'create-utilisateur':
    $utilisateurController->create();
    break;
    case 'edit-utilisateur':
    $utilisateurController->edit();
    break;    
    default:
        echo "Page introuvable.";
        break;
}