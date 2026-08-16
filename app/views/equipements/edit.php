<?php
/** @var array $equipement */
/** @var array $categories */
/** @var array $errors */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un équipement</title>
</head>

<body>

<h1>Modifier un équipement</h1>

<?php if (!empty($errors)): ?>

    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>


<form
    method="POST"
    action="index.php?action=edit-equipement&id=<?= $equipement['id_equipement'] ?>"
>

    <div>
        <label>Nom :</label>

        <input
            type="text"
            name="nom"
            value="<?= htmlspecialchars($equipement['nom']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Référence :</label>

        <input
            type="text"
            name="reference"
            value="<?= htmlspecialchars($equipement['reference']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Description :</label>

        <textarea name="description"><?= htmlspecialchars($equipement['description'] ?? '') ?></textarea>
    </div>

    <br>

    <div>
        <label>Prix journalier :</label>

        <input
            type="number"
            step="0.001"
            name="prix_journalier"
            value="<?= htmlspecialchars($equipement['prix_journalier']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Quantité en stock :</label>

        <input
            type="number"
            name="quantite_stock"
            value="<?= htmlspecialchars($equipement['quantite_stock']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Seuil d'alerte :</label>

        <input
            type="number"
            name="seuil_alerte"
            value="<?= htmlspecialchars($equipement['seuil_alerte']) ?>"
        >
    </div>

    <br>

    <div>
        <label>État :</label>

        <select name="etat">

            <?php
            $etats = [
                'DISPONIBLE' => 'Disponible',
                'EN_LOCATION' => 'En location',
                'EN_MAINTENANCE' => 'En maintenance',
                'ENDOMMAGE' => 'Endommagé'
            ];
            ?>

            <?php foreach ($etats as $valeur => $label): ?>

                <option
                    value="<?= $valeur ?>"
                    <?= $equipement['etat'] === $valeur ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($label) ?>
                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <br>

    <div>
        <label>Catégorie :</label>

        <select name="id_categorie">

            <?php foreach ($categories as $categorie): ?>

                <option
                    value="<?= $categorie['id_categorie'] ?>"
                    <?= (int)$equipement['id_categorie'] ===
                        (int)$categorie['id_categorie']
                        ? 'selected'
                        : '' ?>
                >
                    <?= htmlspecialchars($categorie['nom']) ?>
                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <br>

    <button type="submit">
        Enregistrer les modifications
    </button>

</form>

<br>

<a href="index.php?action=equipements">
    Retour à la liste
</a>

</body>
</html>