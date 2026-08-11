<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
</head>

<body>

    <h1>Ajouter une catégorie</h1>

    <?php if (!empty($errors)): ?>

        <ul>
            <?php foreach ($errors as $error): ?>
                <li>
                    <?= htmlspecialchars($error) ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    <form method="POST" action="index.php?action=create-category">

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
            <label>Description :</label>

            <textarea name="description"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        </div>

        <br>

        <button type="submit">
            Ajouter
        </button>

    </form>

    <br>

    <a href="index.php?action=categories">
        Retour à la liste
    </a>

</body>

</html>