<?php
/** @var array $location */
/** @var array $errors */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Retour d'équipement</title>
</head>

<body>

<h1>Retour d'équipement</h1>

<?php if (!empty($errors)): ?>

    <ul>
        <?php foreach ($errors as $error): ?>
            <li>
                <?= htmlspecialchars($error) ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<p>
    Location n° :
    <?= htmlspecialchars($location['id_location']) ?>
</p>

<form
    method="POST"
    action="index.php?action=return-location&id=<?= $location['id_location'] ?>"
>

    <div>
        <label>État de l'équipement au retour :</label>

        <select name="etat_retour">

            <option value="">
                -- Choisir l'état --
            </option>

            <option value="DISPONIBLE">
                Disponible
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

    <button type="submit">
        Valider le retour
    </button>

</form>

<br>

<a href="index.php?action=locations">
    Retour à la liste
</a>

</body>

</html>