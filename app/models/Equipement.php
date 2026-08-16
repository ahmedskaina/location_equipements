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
}
