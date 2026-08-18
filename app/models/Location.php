<?php

class Location
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = "SELECT
                    l.id_location,
                    l.date_debut,
                    l.date_fin,
                    l.duree,
                    l.quantite,
                    l.prix_total,
                    l.frais_additionnels,
                    l.statut,
                    l.date_demande,

                    u.nom AS client_nom,
                    u.prenom AS client_prenom,

                    e.nom AS equipement_nom,
                    e.reference AS equipement_reference

                FROM location l

                INNER JOIN utilisateur u
                    ON l.id_client = u.id_utilisateur

                INNER JOIN equipement e
                    ON l.id_equipement = e.id_equipement

                ORDER BY l.id_location DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getClients(): array
{
    $sql = "SELECT
                id_utilisateur,
                nom,
                prenom
            FROM utilisateur
            WHERE role = 'CLIENT'
            ORDER BY nom ASC, prenom ASC";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getEquipements(): array
{
    $sql = "SELECT
                id_equipement,
                nom,
                reference,
                prix_journalier,
                quantite_stock,
                etat
            FROM equipement
            ORDER BY nom ASC";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getEquipementById(int $id): array|false
{
    $sql = "SELECT
                id_equipement,
                nom,
                prix_journalier,
                quantite_stock,
                etat
            FROM equipement
            WHERE id_equipement = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function create(
    string $dateDebut,
    string $dateFin,
    int $duree,
    int $quantite,
    float $prixTotal,
    int $idClient,
    int $idEquipement
): bool {

    $sql = "INSERT INTO location
            (
                date_debut,
                date_fin,
                duree,
                quantite,
                prix_total,
                frais_additionnels,
                statut,
                id_client,
                id_equipement
            )
            VALUES
            (
                :date_debut,
                :date_fin,
                :duree,
                :quantite,
                :prix_total,
                0,
                'EN_ATTENTE',
                :id_client,
                :id_equipement
            )";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':date_debut' => $dateDebut,
        ':date_fin' => $dateFin,
        ':duree' => $duree,
        ':quantite' => $quantite,
        ':prix_total' => $prixTotal,
        ':id_client' => $idClient,
        ':id_equipement' => $idEquipement
    ]);
}

}