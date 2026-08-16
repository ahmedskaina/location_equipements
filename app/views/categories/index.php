<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
</head>

<body>

    <h1>Liste des catégories d'équipement</h1>
    <a href="index.php?action=equipements">
    Gestion des équipements
</a>

<br><br>
    <a href="index.php?action=create-category">
    Ajouter une catégorie
</a>

<br><br>

    <?php if (empty($categories)): ?>

        <p>Aucune catégorie disponible.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($categories as $categorie): ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars($categorie['id_categorie']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($categorie['nom']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($categorie['description'] ?? '') ?>
                        </td>
                        <td>

                           <a href="index.php?action=edit-category&id=<?= $categorie['id_categorie'] ?>">
                           Modifier
                           </a>

    |

                           <a
                              href="index.php?action=delete-category&id=<?= $categorie['id_categorie'] ?>"
                              onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');"
                            >
                            Supprimer
                           </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>