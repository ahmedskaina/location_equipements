<?php

class Dashboard
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function countEquipements(): int
    {
        $sql = "SELECT COUNT(*) FROM equipement";

        return (int) $this->pdo
            ->query($sql)
            ->fetchColumn();
    }

    public function countCategories(): int
    {
        $sql = "SELECT COUNT(*)
                FROM categorie_equipement";

        return (int) $this->pdo
            ->query($sql)
            ->fetchColumn();
    }

    public function countClients(): int
    {
        $sql = "SELECT COUNT(*)
                FROM utilisateur
                WHERE role = 'CLIENT'";

        return (int) $this->pdo
            ->query($sql)
            ->fetchColumn();
    }

    public function countLocationsEnAttente(): int
    {
        $sql = "SELECT COUNT(*)
                FROM location
                WHERE statut = 'EN_ATTENTE'";

        return (int) $this->pdo
            ->query($sql)
            ->fetchColumn();
    }

    public function countStocksFaibles(): int
    {
        $sql = "SELECT COUNT(*)
                FROM equipement
                WHERE quantite_stock <= seuil_alerte";

        return (int) $this->pdo
            ->query($sql)
            ->fetchColumn();
    }
}