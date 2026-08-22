<?php
/** @var array $location */
/** @var array $clients */
/** @var array $equipements */
/** @var array $errors */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier une location</title>
</head>

<body>

<h1>Modifier la demande de location</h1>


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
    action="index.php?action=edit-location&id=<?= $location['id_location'] ?>"
>


    <div>

        <label>Client :</label>

        <select name="id_client">

            <?php foreach ($clients as $client): ?>

                <option
                    value="<?= $client['id_utilisateur'] ?>"
                    <?= (int) $location['id_client']
                        ===
                        (int) $client['id_utilisateur']
                        ? 'selected'
                        : '' ?>
                >

                    <?= htmlspecialchars(
                        $client['prenom']
                        . ' '
                        . $client['nom']
                    ) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>


    <br>


    <div>

        <label>Équipement :</label>

        <select name="id_equipement">

            <?php foreach ($equipements as $equipement): ?>

                <option
                    value="<?= $equipement['id_equipement'] ?>"
                    <?= (int) $location['id_equipement']
                        ===
                        (int) $equipement['id_equipement']
                        ? 'selected'
                        : '' ?>
                >

                    <?= htmlspecialchars(
                        $equipement['nom']
                        . ' - '
                        . $equipement['reference']
                    ) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>


    <br>


    <div>

        <label>Date début :</label>

        <input
            type="date"
            name="date_debut"
            value="<?= htmlspecialchars(
                $location['date_debut']
            ) ?>"
        >

    </div>


    <br>


    <div>

        <label>Date fin :</label>

        <input
            type="date"
            name="date_fin"
            value="<?= htmlspecialchars(
                $location['date_fin']
            ) ?>"
        >

    </div>


    <br>


    <div>

        <label>Quantité :</label>

        <input
            type="number"
            name="quantite"
            value="<?= htmlspecialchars(
                $location['quantite']
            ) ?>"
        >

    </div>


    <br>


    <button type="submit">
        Enregistrer les modifications
    </button>

</form>


<br>

<a href="index.php?action=locations">
    Retour à la liste
</a>


</body>
</html>