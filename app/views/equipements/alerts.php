<?php
/** @var array $equipements */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Alertes de stock</title>
</head>

<body>

<h1>Alertes de stock</h1>

<?php if (empty($equipements)): ?>

    <p>Aucune alerte de stock.</p>

<?php else: ?>

    <table border="1" cellpadding="10">

        <thead>
            <tr>
                <th>Équipement</th>
                <th>Référence</th>
                <th>Catégorie</th>
                <th>Stock</th>
                <th>Seuil</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($equipements as $equipement): ?>

            <tr>

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
                    <?= htmlspecialchars($equipement['quantite_stock']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($equipement['seuil_alerte']) ?>
                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>

<br>

<a href="index.php?action=equipements">
    Retour aux équipements
</a>

</body>

</html>