<?php

class CategorieEquipement
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = "SELECT *
                FROM categorie_equipement
                ORDER BY id_categorie DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $nom, string $description): bool
    {
        $sql = "INSERT INTO categorie_equipement (nom, description)
                VALUES (:nom, :description)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom' => $nom,
            ':description' => $description
        ]);
    }
}