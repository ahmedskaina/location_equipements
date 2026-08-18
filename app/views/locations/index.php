<?php
/** @var array $locations */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des locations</title>
</head>

<body>

<h1>Liste des locations</h1>

<a href="index.php?action=create-location">
    Ajouter une demande de location
</a>

<br><br>


<?php if (empty($locations)): ?>

    <p>Aucune location disponible.</p>

<?php else: ?>

    <table border="1" cellpadding="10">

        <thead>

            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Équipement</th>
                <th>Référence</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Durée</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>Frais additionnels</th>
                <th>Statut</th>
                <th>Date demande</th>
            </tr>

        </thead>

        <tbody>

        <?php foreach ($locations as $location): ?>

            <tr>

                <td>
                    <?= htmlspecialchars($location['id_location']) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $location['client_prenom']
                        . ' '
                        . $location['client_nom']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['equipement_nom']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['equipement_reference']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['date_debut']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['date_fin']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['duree']) ?>
                    jour(s)
                </td>

                <td>
                    <?= htmlspecialchars($location['quantite']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['prix_total']) ?>
                    DT
                </td>

                <td>
                    <?= htmlspecialchars($location['frais_additionnels']) ?>
                    DT
                </td>

                <td>
                    <?= htmlspecialchars($location['statut']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($location['date_demande']) ?>
                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>

<br>

<a href="index.php?action=equipements">
    Gestion des équipements
</a>

<br><br>

<a href="index.php?action=utilisateurs">
    Gestion des utilisateurs
</a>

</body>

</html>