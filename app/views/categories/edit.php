<?php
/** @var array $categorie */
/** @var array $errors */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier une catégorie</title>
</head>

<body>

    <h1>Modifier une catégorie</h1>

    <?php if (!empty($errors)): ?>

        <ul>
            <?php foreach ($errors as $error): ?>

                <li>
                    <?= htmlspecialchars($error) ?>
                </li>

            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    <form
        method="POST"
        action="index.php?action=edit-category&id=<?= $categorie['id_categorie'] ?>"
    >

        <div>
            <label>Nom :</label>

            <input
                type="text"
                name="nom"
                value="<?= htmlspecialchars($categorie['nom']) ?>"
            >
        </div>

        <br>

        <div>
            <label>Description :</label>

            <textarea name="description"><?= htmlspecialchars($categorie['description'] ?? '') ?></textarea>
        </div>

        <br>

        <button type="submit">
            Enregistrer les modifications
        </button>

    </form>

    <br>

    <a href="index.php?action=categories">
        Retour à la liste
    </a>

</body>

</html>