<?php
/** @var array $equipements */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue des équipements</title>
</head>

<body>

<h1>Espace Client</h1>

<p>
    Bienvenue
    <?= htmlspecialchars(
        $_SESSION['utilisateur']['prenom']
    ) ?>

    <?= htmlspecialchars(
        $_SESSION['utilisateur']['nom']
    ) ?>
</p>

<a href="index.php?action=client-my-locations">
    Mes locations
</a>

|

<a href="index.php?action=logout">
    Déconnexion
</a>

<hr>

<h2>Catalogue des équipements disponibles</h2>


<?php if (empty($equipements)): ?>

    <p>
        Aucun équipement disponible actuellement.
    </p>

<?php else: ?>

    <div>

        <?php foreach ($equipements as $equipement): ?>

            <div
                style="
                    border:1px solid #ccc;
                    padding:15px;
                    margin-bottom:20px;
                    width:300px;
                "
            >

                <?php if (!empty($equipement['image'])): ?>

                    <img
                        src="images/<?= htmlspecialchars(
                            $equipement['image']
                        ) ?>"
                        alt="<?= htmlspecialchars(
                            $equipement['nom']
                        ) ?>"
                        width="200"
                    >

                <?php else: ?>

                    <p>Aucune image</p>

                <?php endif; ?>


                <h3>
                    <?= htmlspecialchars(
                        $equipement['nom']
                    ) ?>
                </h3>


                <p>
                    <strong>Référence :</strong>

                    <?= htmlspecialchars(
                        $equipement['reference']
                    ) ?>
                </p>


                <p>
                    <strong>Catégorie :</strong>

                    <?= htmlspecialchars(
                        $equipement['nom_categorie']
                    ) ?>
                </p>


                <p>
                    <strong>Description :</strong>

                    <?= htmlspecialchars(
                        $equipement['description'] ?? ''
                    ) ?>
                </p>


                <p>
                    <strong>Prix / jour :</strong>

                    <?= htmlspecialchars(
                        $equipement['prix_journalier']
                    ) ?>

                    DT
                </p>


                <p>
                    <strong>Stock :</strong>

                    <?= htmlspecialchars(
                        $equipement['quantite_stock']
                    ) ?>
                </p>


                <p>
                    <strong>État :</strong>

                    Disponible
                </p>
                <a href="index.php?action=client-location-create&id=<?= $equipement['id_equipement'] ?>">
    Louer
</a>

            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>


</body>
</html>