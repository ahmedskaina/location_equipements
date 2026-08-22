<?php
session_start();

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../app/helpers/auth.php';
require_once __DIR__ . '/../app/controllers/CategorieController.php';
require_once __DIR__ . '/../app/controllers/EquipementController.php';
require_once __DIR__ . '/../app/controllers/UtilisateurController.php';
require_once __DIR__ . '/../app/controllers/LocationController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';


$authController = new AuthController($pdo);
$categorieController = new CategorieController($pdo);
$equipementController = new EquipementController($pdo);
$utilisateurController = new UtilisateurController($pdo);
$locationController = new LocationController($pdo);

$action = $_GET['action'] ?? 'categories';

switch ($action) {
    case 'login':
        $authController->login();
    break;

    case 'logout':
        $authController->logout();
        break;

    case 'categories':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $categorieController->index();

    break;

    case 'create-category':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $categorieController->create();

    break;


case 'edit-category':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $categorieController->edit();

    break;


case 'delete-category':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $categorieController->delete();

    break;

    case 'equipements':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $equipementController->index();

    break;
   case 'create-equipement':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $equipementController->create();

    break;


case 'edit-equipement':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $equipementController->edit();

    break;


case 'delete-equipement':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $equipementController->delete();

    break;
    case 'utilisateurs':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $utilisateurController->index();

    break;


case 'create-utilisateur':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $utilisateurController->create();

    break;


case 'edit-utilisateur':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $utilisateurController->edit();

    break;


case 'delete-utilisateur':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $utilisateurController->delete();

    break;
    case 'locations':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->index();

    break;
    case 'create-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->create();

    break;
    case 'validate-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->validate();

    break;


case 'refuse-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->refuse();

    break;


case 'start-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->start();

    break;


case 'return-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->returnEquipment();

    break;
    case 'search-equipements':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $equipementController->search();

    break;


case 'stock-alerts':

    requireRole([
        'RESPONSABLE_INVENTAIRE'
    ]);

    $equipementController->alerts();

    break;
    case 'edit-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->edit();

    break;
    case 'delete-location':

    requireRole([
        'AGENT_LOCATION'
    ]);

    $locationController->delete();

    break; 
    case 'client-home':

    requireRole([
        'CLIENT'
    ]);

    require __DIR__
        . '/../app/views/client/home.php';

    break; 
    default:
        echo "Page introuvable.";
        break;
}