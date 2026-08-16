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
    public function create(
    string $nom,
    string $prenom,
    string $email,
    string $motDePasse,
    string $telephone,
    string $role
): bool {

    $sql = "INSERT INTO utilisateur
            (
                nom,
                prenom,
                email,
                mot_de_passe,
                telephone,
                role
            )
            VALUES
            (
                :nom,
                :prenom,
                :email,
                :mot_de_passe,
                :telephone,
                :role
            )";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':mot_de_passe' => $motDePasse,
        ':telephone' => $telephone,
        ':role' => $role
    ]);
}
public function emailExists(string $email): bool
{
    $sql = "SELECT COUNT(*)
            FROM utilisateur
            WHERE email = :email";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetchColumn() > 0;
}
}