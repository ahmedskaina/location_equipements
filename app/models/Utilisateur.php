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
public function getById(int $id): array|false
{
    $sql = "SELECT
                id_utilisateur,
                nom,
                prenom,
                email,
                telephone,
                role
            FROM utilisateur
            WHERE id_utilisateur = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function emailExistsForOtherUser(
    string $email,
    int $id
): bool {

    $sql = "SELECT COUNT(*)
            FROM utilisateur
            WHERE email = :email
            AND id_utilisateur != :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email,
        ':id' => $id
    ]);

    return $stmt->fetchColumn() > 0;
}
public function update(
    int $id,
    string $nom,
    string $prenom,
    string $email,
    string $telephone,
    string $role
): bool {

    $sql = "UPDATE utilisateur
            SET nom = :nom,
                prenom = :prenom,
                email = :email,
                telephone = :telephone,
                role = :role
            WHERE id_utilisateur = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':role' => $role,
        ':id' => $id
    ]);
}
public function delete(int $id): bool
{
    $sql = "DELETE FROM utilisateur
            WHERE id_utilisateur = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
}
public function findByEmail(string $email): array|false
{
    $sql = "SELECT *
            FROM utilisateur
            WHERE email = :email";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}