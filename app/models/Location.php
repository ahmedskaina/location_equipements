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
}