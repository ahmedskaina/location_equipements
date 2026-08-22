<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des équipements</title>
</head>

<body>
<?php if (isset($_SESSION['utilisateur'])): ?>

    <p>
        Connecté :
        <?= htmlspecialchars(
            $_SESSION['utilisateur']['prenom']
        ) ?>

        <?= htmlspecialchars(
            $_SESSION['utilisateur']['nom']
        ) ?>

        -

        <?= htmlspecialchars(
            $_SESSION['utilisateur']['role']
        ) ?>
    </p>
<a href="index.php?action=logout">
    Déconnexion
</a>

<br><br>
<?php endif; ?>
    <h1>Liste des équipements</h1>
    <a href="index.php?action=search-equipements">
    Recherche multicritère
</a>

<br><br>
    <a href="index.php?action=stock-alerts">
    Voir les alertes de stock
</a>

<br><br>
    <a href="index.php?action=locations">
    Gestion des locations
</a>

<br><br>
    <a href="index.php?action=utilisateurs">
    Gestion des utilisateurs
</a>

<br><br>
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
        <th>Alerte stock</th>
        <th>État</th>
        <th>Actions</th>
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

<td>

    <?php if (
        (int) $equipement['quantite_stock']
        <=
        (int) $equipement['seuil_alerte']
    ): ?>

        Stock faible

    <?php else: ?>

        Stock suffisant

    <?php endif; ?>

</td>
        <!-- État -->
        <td>
            <?= htmlspecialchars($equipement['etat']) ?>
        </td>

       <td>

    <a href="index.php?action=edit-equipement&id=<?= $equipement['id_equipement'] ?>">
        Modifier
    </a>

    |

    <a
        href="index.php?action=delete-equipement&id=<?= $equipement['id_equipement'] ?>"
        onclick="return confirm('Voulez-vous vraiment supprimer cet équipement ?');"
    >
        Supprimer
    </a>

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