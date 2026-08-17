<?php
/** @var array $utilisateur */
/** @var array $errors */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
</head>

<body>

<h1>Modifier un utilisateur</h1>

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
    action="index.php?action=edit-utilisateur&id=<?= $utilisateur['id_utilisateur'] ?>"
>

    <div>
        <label>Nom :</label>

        <input
            type="text"
            name="nom"
            value="<?= htmlspecialchars($utilisateur['nom']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Prénom :</label>

        <input
            type="text"
            name="prenom"
            value="<?= htmlspecialchars($utilisateur['prenom']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Email :</label>

        <input
            type="text"
            name="email"
            value="<?= htmlspecialchars($utilisateur['email']) ?>"
        >
    </div>

    <br>

    <div>
        <label>Téléphone :</label>

        <input
            type="text"
            name="telephone"
            value="<?= htmlspecialchars($utilisateur['telephone'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Rôle :</label>

        <select name="role">

            <?php
            $roles = [
                'CLIENT' => 'Client',
                'AGENT_LOCATION' => 'Agent de location',
                'RESPONSABLE_INVENTAIRE' => 'Responsable inventaire'
            ];
            ?>

            <?php foreach ($roles as $valeur => $label): ?>

                <option
                    value="<?= $valeur ?>"
                    <?= $utilisateur['role'] === $valeur
                        ? 'selected'
                        : '' ?>
                >
                    <?= htmlspecialchars($label) ?>
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

<a href="index.php?action=utilisateurs">
    Retour à la liste
</a>

</body>
</html>