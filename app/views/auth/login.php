<?php
/** @var array $errors */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>

<h1>Connexion</h1>

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
    action="index.php?action=login"
>

    <div>

        <label>Email :</label>

        <input
    type="email"
    name="email"
    autocomplete="username"
    value="<?= htmlspecialchars(
        $_POST['email'] ?? ''
    ) ?>"
>

    </div>


    <br>


    <div>

        <label>Mot de passe :</label>

        <input
    type="password"
    name="mot_de_passe"
    autocomplete="current-password"
>

    </div>


    <br>


    <button type="submit">
        Se connecter
    </button>

</form>


</body>
</html>