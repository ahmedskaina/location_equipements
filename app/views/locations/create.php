<?php
/** @var array $clients */
/** @var array $equipements */
/** @var array $errors */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une location</title>
</head>

<body>

<h1>Ajouter une demande de location</h1>

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
    action="index.php?action=create-location"
>

    <div>
        <label>Client :</label>

        <select name="id_client">

            <option value="0">
                -- Choisir un client --
            </option>

            <?php foreach ($clients as $client): ?>

                <option
                    value="<?= $client['id_utilisateur'] ?>"
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

            <option value="0">
                -- Choisir un équipement --
            </option>

            <?php foreach ($equipements as $equipement): ?>

                <option
                    value="<?= $equipement['id_equipement'] ?>"
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
            value="<?= htmlspecialchars($_POST['date_debut'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Date fin :</label>

        <input
            type="date"
            name="date_fin"
            value="<?= htmlspecialchars($_POST['date_fin'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Quantité :</label>

        <input
            type="number"
            name="quantite"
            value="<?= htmlspecialchars($_POST['quantite'] ?? '1') ?>"
        >
    </div>

    <br>

    <button type="submit">
        Enregistrer la demande
    </button>

</form>

<br>

<a href="index.php?action=locations">
    Retour à la liste
</a>

</body>
</html>