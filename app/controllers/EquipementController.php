<?php

require_once __DIR__ . '/../models/Equipement.php';

class EquipementController
{
    private Equipement $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Equipement($pdo);
    }

    public function index(): void
    {
        $equipements = $this->model->getAll();

        require __DIR__ . '/../views/equipements/index.php';
    }
}