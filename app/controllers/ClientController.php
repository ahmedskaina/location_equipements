<?php

require_once __DIR__ . '/../models/Equipement.php';

class ClientController
{
    private Equipement $equipementModel;

    public function __construct(PDO $pdo)
    {
        $this->equipementModel = new Equipement($pdo);
    }

    public function home(): void
    {
        $equipements =
            $this->equipementModel->getDisponibles();

        require __DIR__ . '/../views/client/home.php';
    }
}