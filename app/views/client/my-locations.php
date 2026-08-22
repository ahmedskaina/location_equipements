<?php
/** @var array $locations */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes locations</title>
</head>

<body>

<h1>Mes demandes de location</h1>

<?php if (empty($locations)): ?>

    <p>
        Vous n'avez aucune demande de location.
    </p>

<?php else: ?>

    <table border="1" cellpadding="10">

        <thead>

            <tr>
                <th>Équipement</th>
                <th>Référence</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Durée</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Statut</th>
            </tr>

        </thead>

        <tbody>

        <?php foreach ($locations as $location): ?>

            <tr>

                <td>
                    <?= htmlspecialchars(
                        $location['equipement_nom']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['equipement_reference']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['date_debut']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['date_fin']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['duree']
                    ) ?>
                    jour(s)
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['quantite']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['prix_total']
                    ) ?>
                    DT
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['statut']
                    ) ?>
                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>

<br>

<a href="index.php?action=client-home">
    Retour au catalogue
</a>

</body>

</html>