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
    public function getById(int $id): array|false
{
    $sql = "SELECT *
            FROM categorie_equipement
            WHERE id_categorie = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function update(
    int $id,
    string $nom,
    string $description
): bool {
    $sql = "UPDATE categorie_equipement
            SET nom = :nom,
                description = :description
            WHERE id_categorie = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nom' => $nom,
        ':description' => $description,
        ':id' => $id
    ]);
}

}