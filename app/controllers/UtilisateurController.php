<?php

require_once __DIR__ . '/../models/Utilisateur.php';

class UtilisateurController
{
    private Utilisateur $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Utilisateur($pdo);
    }

    public function index(): void
    {
        $utilisateurs = $this->model->getAll();

        require __DIR__ . '/../views/utilisateurs/index.php';
    }
}