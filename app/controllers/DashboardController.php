<?php

require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController
{
    private Dashboard $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Dashboard($pdo);
    }

    public function index(): void
    {
        $nombreEquipements =
            $this->model->countEquipements();

        $nombreCategories =
            $this->model->countCategories();

        $nombreClients =
            $this->model->countClients();

        $locationsEnAttente =
            $this->model->countLocationsEnAttente();

        $stocksFaibles =
            $this->model->countStocksFaibles();

        require __DIR__
            . '/../views/dashboard/index.php';
    }
}