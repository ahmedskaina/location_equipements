<?php

class Equipement
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function getCategories(): array
{
    $sql = "SELECT id_categorie, nom
            FROM categorie_equipement
            ORDER BY nom ASC";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getAll(): array
    {
        $sql = "SELECT
                    e.id_equipement,
                    e.nom,
                    e.reference,
                    e.description,
                    e.prix_journalier,
                    e.quantite_stock,
                    e.seuil_alerte,
                    e.etat,
                    e.image,
                    c.nom AS nom_categorie
                FROM equipement e
                INNER JOIN categorie_equipement c
                    ON e.id_categorie = c.id_categorie
                ORDER BY e.id_equipement DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(
    string $nom,
    string $reference,
    string $description,
    float $prixJournalier,
    int $quantiteStock,
    int $seuilAlerte,
    string $etat,
    ?string $image,
    int $idCategorie
): bool {

    $sql = "INSERT INTO equipement
            (
                nom,
                reference,
                description,
                prix_journalier,
                quantite_stock,
                seuil_alerte,
                etat,
                image,
                id_categorie
            )
            VALUES
            (
                :nom,
                :reference,
                :description,
                :prix_journalier,
                :quantite_stock,
                :seuil_alerte,
                :etat,
                :image,
                :id_categorie
            )";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nom' => $nom,
        ':reference' => $reference,
        ':description' => $description,
        ':prix_journalier' => $prixJournalier,
        ':quantite_stock' => $quantiteStock,
        ':seuil_alerte' => $seuilAlerte,
        ':etat' => $etat,
        ':image' => $image,
        ':id_categorie' => $idCategorie
    ]);
}
public function getById(int $id): array|false
{
    $sql = "SELECT *
            FROM equipement
            WHERE id_equipement = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function update(
    int $id,
    string $nom,
    string $reference,
    string $description,
    float $prixJournalier,
    int $quantiteStock,
    int $seuilAlerte,
    string $etat,
    int $idCategorie
): bool {

    $sql = "UPDATE equipement
            SET nom = :nom,
                reference = :reference,
                description = :description,
                prix_journalier = :prix_journalier,
                quantite_stock = :quantite_stock,
                seuil_alerte = :seuil_alerte,
                etat = :etat,
                id_categorie = :id_categorie
            WHERE id_equipement = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nom' => $nom,
        ':reference' => $reference,
        ':description' => $description,
        ':prix_journalier' => $prixJournalier,
        ':quantite_stock' => $quantiteStock,
        ':seuil_alerte' => $seuilAlerte,
        ':etat' => $etat,
        ':id_categorie' => $idCategorie,
        ':id' => $id
    ]);
}
public function delete(int $id): bool
{
    $sql = "DELETE FROM equipement
            WHERE id_equipement = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
}
public function updateEtat(
    int $id,
    string $etat
): bool {

    $sql = "UPDATE equipement
            SET etat = :etat
            WHERE id_equipement = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':etat' => $etat,
        ':id' => $id
    ]);
}
public function getStocksFaibles(): array
{
    $sql = "SELECT
                e.id_equipement,
                e.nom,
                e.reference,
                e.quantite_stock,
                e.seuil_alerte,
                c.nom AS nom_categorie

            FROM equipement e

            INNER JOIN categorie_equipement c
                ON e.id_categorie = c.id_categorie

            WHERE e.quantite_stock <= e.seuil_alerte

            ORDER BY e.quantite_stock ASC";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function search(
    string $nom,
    int $idCategorie,
    string $etat,
    ?float $prixMax,
    bool $stockDisponible
): array {

    $sql = "SELECT
                e.id_equipement,
                e.nom,
                e.reference,
                e.description,
                e.prix_journalier,
                e.quantite_stock,
                e.seuil_alerte,
                e.etat,
                e.image,
                c.nom AS nom_categorie

            FROM equipement e

            INNER JOIN categorie_equipement c
                ON e.id_categorie = c.id_categorie

            WHERE 1 = 1";

    $params = [];


    if ($nom !== '') {

        $sql .= " AND e.nom LIKE :nom";

        $params[':nom'] = '%' . $nom . '%';
    }


    if ($idCategorie > 0) {

        $sql .= " AND e.id_categorie = :id_categorie";

        $params[':id_categorie'] = $idCategorie;
    }


    if ($etat !== '') {

        $sql .= " AND e.etat = :etat";

        $params[':etat'] = $etat;
    }


    if ($prixMax !== null && $prixMax > 0) {

        $sql .= " AND e.prix_journalier <= :prix_max";

        $params[':prix_max'] = $prixMax;
    }


    if ($stockDisponible) {

        $sql .= " AND e.quantite_stock > 0";
    }


    $sql .= " ORDER BY e.nom ASC";


    $stmt = $this->pdo->prepare($sql);

    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getDisponibles(): array
{
    $sql = "SELECT
                e.id_equipement,
                e.nom,
                e.reference,
                e.description,
                e.prix_journalier,
                e.quantite_stock,
                e.etat,
                e.image,
                c.nom AS nom_categorie

            FROM equipement e

            INNER JOIN categorie_equipement c
                ON e.id_categorie = c.id_categorie

            WHERE e.etat = 'DISPONIBLE'
            AND e.quantite_stock > 0

            ORDER BY e.nom ASC";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
