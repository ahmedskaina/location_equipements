<?php
/** @var array $utilisateurs */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>

<body>

    <h1>Liste des utilisateurs</h1>

    <?php if (empty($utilisateurs)): ?>

        <p>Aucun utilisateur disponible.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($utilisateurs as $utilisateur): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($utilisateur['id_utilisateur']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($utilisateur['nom']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($utilisateur['prenom']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($utilisateur['email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($utilisateur['telephone'] ?? '') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($utilisateur['role']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

    <br>

    <a href="index.php?action=equipements">
        Gestion des équipements
    </a>

</body>

</html>