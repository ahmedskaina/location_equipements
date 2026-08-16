<?php

class Utilisateur
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = "SELECT
                    id_utilisateur,
                    nom,
                    prenom,
                    email,
                    telephone,
                    role
                FROM utilisateur
                ORDER BY id_utilisateur DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}