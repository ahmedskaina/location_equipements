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
}