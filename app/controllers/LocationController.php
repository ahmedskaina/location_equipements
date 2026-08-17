<?php

require_once __DIR__ . '/../models/Location.php';

class LocationController
{
    private Location $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Location($pdo);
    }

    public function index(): void
    {
        $locations = $this->model->getAll();

        require __DIR__ . '/../views/locations/index.php';
    }
}