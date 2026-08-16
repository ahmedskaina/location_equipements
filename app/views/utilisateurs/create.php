<?php
/** @var array $errors */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
</head>

<body>

<h1>Ajouter un utilisateur</h1>

<?php if (!empty($errors)): ?>

    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>


<form method="POST" action="index.php?action=create-utilisateur">

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
        <label>Prénom :</label>

        <input
            type="text"
            name="prenom"
            value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Email :</label>

        <input
            type="text"
            name="email"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Téléphone :</label>

        <input
            type="text"
            name="telephone"
            value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Mot de passe :</label>

        <input
            type="password"
            name="mot_de_passe"
        >
    </div>

    <br>

    <div>
        <label>Rôle :</label>

        <select name="role">

            <option value="">
                -- Choisir un rôle --
            </option>

            <option value="CLIENT">
                Client
            </option>

            <option value="AGENT_LOCATION">
                Agent de location
            </option>

            <option value="RESPONSABLE_INVENTAIRE">
                Responsable inventaire
            </option>

        </select>
    </div>

    <br>

    <button type="submit">
        Ajouter l'utilisateur
    </button>

</form>

<br>

<a href="index.php?action=utilisateurs">
    Retour à la liste
</a>

</body>
</html>