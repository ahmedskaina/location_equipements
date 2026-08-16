<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des équipements</title>
</head>

<body>

    <h1>Liste des équipements</h1>
    <a href="index.php?action=create-equipement">
    Ajouter un équipement
</a>

<br><br>

    <?php if (empty($equipements)): ?>

        <p>Aucun équipement disponible.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Prix / jour</th>
                    <th>Stock</th>
                    <th>Seuil d'alerte</th>
                    <th>État</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($equipements as $equipement): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($equipement['id_equipement']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['nom']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['reference']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['nom_categorie']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['prix_journalier']) ?> DT
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['quantite_stock']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['seuil_alerte']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($equipement['etat']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

    <br>

    <a href="index.php?action=categories">
        Gestion des catégories
    </a>

</body>

</html>