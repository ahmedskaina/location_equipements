<?php
/** @var array $categories */
/** @var array $errors */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un équipement</title>
</head>

<body>

    <h1>Ajouter un équipement</h1>

    <?php if (!empty($errors)): ?>

        <ul>
            <?php foreach ($errors as $error): ?>
                <li>
                    <?= htmlspecialchars($error) ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    <form method="POST" action="index.php?action=create-equipement" enctype="multipart/form-data">

        <div>
            <label>Nom :</label>

            <input
                type="text"
                name="nom"
                value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
            >
        </div>

        <br>

        <div>
            <label>Référence :</label>

            <input
                type="text"
                name="reference"
                value="<?= htmlspecialchars($_POST['reference'] ?? '') ?>"
            >
        </div>

        <br>

        <div>
            <label>Description :</label>

            <textarea name="description"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        </div>

        <br>

        <div>
            <label>Prix journalier :</label>

            <input
                type="number"
                step="0.001"
                name="prix_journalier"
                value="<?= htmlspecialchars($_POST['prix_journalier'] ?? '') ?>"
            >
        </div>

        <br>

        <div>
            <label>Quantité en stock :</label>

            <input
                type="number"
                name="quantite_stock"
                value="<?= htmlspecialchars($_POST['quantite_stock'] ?? '0') ?>"
            >
        </div>

        <br>

        <div>
            <label>Seuil d'alerte :</label>

            <input
                type="number"
                name="seuil_alerte"
                value="<?= htmlspecialchars($_POST['seuil_alerte'] ?? '0') ?>"
            >
        </div>

        <br>

        <div>
            <label>État :</label>

            <select name="etat">

                <option value="DISPONIBLE">
                    Disponible
                </option>

                <option value="EN_LOCATION">
                    En location
                </option>

                <option value="EN_MAINTENANCE">
                    En maintenance
                </option>

                <option value="ENDOMMAGE">
                    Endommagé
                </option>

            </select>
        </div>

        <br>

        <div>
            <label>Catégorie :</label>

            <select name="id_categorie">

                <option value="0">
                    -- Choisir une catégorie --
                </option>

                <?php foreach ($categories as $categorie): ?>

                    <option
                        value="<?= $categorie['id_categorie'] ?>"
                    >
                        <?= htmlspecialchars($categorie['nom']) ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>
        <div>
                 <label>Image :</label>

             <input
            type="file"
            name="image"
            accept=".jpg,.jpeg,.png"
             >
        </div>

<br>

        <br>

        <button type="submit">
            Ajouter l'équipement
        </button>

    </form>

    <br>

    <a href="index.php?action=equipements">
        Retour à la liste
    </a>

</body>

</html>