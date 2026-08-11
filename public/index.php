<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/CategorieController.php';

$controller = new CategorieController($pdo);

$controller->index();