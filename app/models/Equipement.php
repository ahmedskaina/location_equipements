<?php

class Equipement
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
}