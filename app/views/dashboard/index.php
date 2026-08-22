<?php
/** @var int $nombreEquipements */
/** @var int $nombreCategories */
/** @var int $nombreClients */
/** @var int $locationsEnAttente */
/** @var int $stocksFaibles */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>

<body>

<h1>Tableau de bord</h1>

<p>
    Bienvenue
    <?= htmlspecialchars(
        $_SESSION['utilisateur']['prenom']
    ) ?>

    <?= htmlspecialchars(
        $_SESSION['utilisateur']['nom']
    ) ?>

    -
    <?= htmlspecialchars(
        $_SESSION['utilisateur']['role']
    ) ?>
</p>

<hr>

<h2>Statistiques</h2>

<div>

    <p>
        <strong>Équipements :</strong>
        <?= $nombreEquipements ?>
    </p>

    <p>
        <strong>Catégories :</strong>
        <?= $nombreCategories ?>
    </p>

    <p>
        <strong>Clients :</strong>
        <?= $nombreClients ?>
    </p>

    <p>
        <strong>Locations en attente :</strong>
        <?= $locationsEnAttente ?>
    </p>

    <p>
        <strong>Stocks faibles :</strong>
        <?= $stocksFaibles ?>
    </p>

</div>

<hr>

<h2>Navigation</h2>

<?php if (
    $_SESSION['utilisateur']['role']
    === 'RESPONSABLE_INVENTAIRE'
): ?>

    <a href="index.php?action=equipements">
        Gestion des équipements
    </a>

    <br><br>

    <a href="index.php?action=categories">
        Gestion des catégories
    </a>

    <br><br>

    <a href="index.php?action=utilisateurs">
        Gestion des utilisateurs
    </a>

    <br><br>

    <a href="index.php?action=stock-alerts">
        Alertes de stock
    </a>

    <br><br>

    <a href="index.php?action=search-equipements">
        Recherche multicritère
    </a>


<?php elseif (
    $_SESSION['utilisateur']['role']
    === 'AGENT_LOCATION'
): ?>

    <a href="index.php?action=locations">
        Gestion des locations
    </a>

<?php endif; ?>

<br><br>

<a href="index.php?action=logout">
    Déconnexion
</a>

</body>

</html>