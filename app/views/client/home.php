<?php
/** @var array $utilisateur */
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Espace Client</title>
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

<p>
    Le FrontOffice Client sera développé dans la prochaine partie.
</p>

<a href="index.php?action=logout">
    Déconnexion
</a>

</body>

</html>