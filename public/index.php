<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/CategorieController.php';

$controller = new CategorieController($pdo);

$action = $_GET['action'] ?? 'categories';

switch ($action) {

    case 'categories':
        $controller->index();
        break;

    case 'create-category':
        $controller->create();
        break;

    case 'edit-category':
        $controller->edit();
        break;

    case 'delete-category':
        $controller->delete();
        break;

    default:
        echo "Page introuvable.";
        break;
}