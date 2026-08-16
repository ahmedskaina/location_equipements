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
        <th>Image</th>
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

        <!-- ID -->
        <td>
            <?= htmlspecialchars($equipement['id_equipement']) ?>
        </td>


        <!-- Image -->
        <td>
            <?php if (!empty($equipement['image'])): ?>

                <img
                    src="images/<?= htmlspecialchars($equipement['image']) ?>"
                    alt="<?= htmlspecialchars($equipement['nom']) ?>"
                    width="100"
                >

            <?php else: ?>

                Aucune image

            <?php endif; ?>
        </td>


        <!-- Nom -->
        <td>
            <?= htmlspecialchars($equipement['nom']) ?>
        </td>


        <!-- Référence -->
        <td>
            <?= htmlspecialchars($equipement['reference']) ?>
        </td>


        <!-- Catégorie -->
        <td>
            <?= htmlspecialchars($equipement['nom_categorie']) ?>
        </td>


        <!-- Prix -->
        <td>
            <?= htmlspecialchars($equipement['prix_journalier']) ?> DT
        </td>


        <!-- Stock -->
        <td>
            <?= htmlspecialchars($equipement['quantite_stock']) ?>
        </td>


        <!-- Seuil d'alerte -->
        <td>
            <?= htmlspecialchars($equipement['seuil_alerte']) ?>
        </td>


        <!-- État -->
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