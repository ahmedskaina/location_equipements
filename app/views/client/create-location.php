<?php
/** @var array $equipement */
/** @var array $errors */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Demande de location</title>
</head>

<body>

<h1>Demande de location</h1>

<h2>
    <?= htmlspecialchars($equipement['nom']) ?>
</h2>

<p>
    Prix journalier :
    <?= htmlspecialchars(
        $equipement['prix_journalier']
    ) ?>
    DT
</p>

<p>
    Stock :
    <?= htmlspecialchars(
        $equipement['quantite_stock']
    ) ?>
</p>


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
    action="index.php?action=client-location-create&id=<?= $equipement['id_equipement'] ?>"
>

    <div>

        <label>Date début :</label>

        <input
            type="date"
            name="date_debut"
            value="<?= htmlspecialchars(
                $_POST['date_debut'] ?? ''
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
                $_POST['date_fin'] ?? ''
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
                $_POST['quantite'] ?? '1'
            ) ?>"
        >

    </div>

    <br>

    <button type="submit">
        Envoyer la demande
    </button>

</form>

<br>

<a href="index.php?action=client-home">
    Retour au catalogue
</a>

</body>

</html>