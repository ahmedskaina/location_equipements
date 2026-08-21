<?php
/** @var array $equipements */
/** @var array $categories */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Recherche des équipements</title>
</head>

<body>

<h1>Recherche multicritère des équipements</h1>


<form
    method="GET"
    action="index.php"
>

    <input
        type="hidden"
        name="action"
        value="search-equipements"
    >


    <div>
        <label>Nom :</label>

        <input
            type="text"
            name="nom"
            value="<?= htmlspecialchars($_GET['nom'] ?? '') ?>"
        >
    </div>

    <br>


    <div>
        <label>Catégorie :</label>

        <select name="id_categorie">

            <option value="0">
                Toutes les catégories
            </option>

            <?php foreach ($categories as $categorie): ?>

                <option
                    value="<?= $categorie['id_categorie'] ?>"
                    <?= (int) ($_GET['id_categorie'] ?? 0)
                        ===
                        (int) $categorie['id_categorie']
                        ? 'selected'
                        : '' ?>
                >
                    <?= htmlspecialchars($categorie['nom']) ?>
                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <br>


    <div>
        <label>État :</label>

        <select name="etat">

            <option value="">
                Tous les états
            </option>

            <option
                value="DISPONIBLE"
                <?= ($_GET['etat'] ?? '') === 'DISPONIBLE'
                    ? 'selected'
                    : '' ?>
            >
                Disponible
            </option>

            <option
                value="EN_LOCATION"
                <?= ($_GET['etat'] ?? '') === 'EN_LOCATION'
                    ? 'selected'
                    : '' ?>
            >
                En location
            </option>

            <option
                value="EN_MAINTENANCE"
                <?= ($_GET['etat'] ?? '') === 'EN_MAINTENANCE'
                    ? 'selected'
                    : '' ?>
            >
                En maintenance
            </option>

            <option
                value="ENDOMMAGE"
                <?= ($_GET['etat'] ?? '') === 'ENDOMMAGE'
                    ? 'selected'
                    : '' ?>
            >
                Endommagé
            </option>

        </select>
    </div>

    <br>


    <div>
        <label>Prix journalier maximum :</label>

        <input
            type="number"
            step="0.001"
            name="prix_max"
            value="<?= htmlspecialchars($_GET['prix_max'] ?? '') ?>"
        >

        DT
    </div>

    <br>


    <div>

        <label>

            <input
                type="checkbox"
                name="stock_disponible"
                value="1"
                <?= ($_GET['stock_disponible'] ?? '') === '1'
                    ? 'checked'
                    : '' ?>
            >

            Stock supérieur à 0

        </label>

    </div>

    <br>


    <button type="submit">
        Rechercher
    </button>

</form>


<hr>


<h2>Résultats</h2>


<?php if (empty($equipements)): ?>

    <p>Aucun équipement trouvé.</p>

<?php else: ?>

    <table border="1" cellpadding="10">

        <thead>

            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Référence</th>
                <th>Catégorie</th>
                <th>Prix / jour</th>
                <th>Stock</th>
                <th>État</th>
            </tr>

        </thead>


        <tbody>

        <?php foreach ($equipements as $equipement): ?>

            <tr>

                <td>

                    <?php if (!empty($equipement['image'])): ?>

                        <img
                            src="images/<?= htmlspecialchars($equipement['image']) ?>"
                            width="80"
                            alt="<?= htmlspecialchars($equipement['nom']) ?>"
                        >

                    <?php else: ?>

                        Aucune image

                    <?php endif; ?>

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
                    <?= htmlspecialchars($equipement['prix_journalier']) ?>
                    DT
                </td>


                <td>
                    <?= htmlspecialchars($equipement['quantite_stock']) ?>
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

<a href="index.php?action=equipements">
    Retour aux équipements
</a>

</body>

</html>