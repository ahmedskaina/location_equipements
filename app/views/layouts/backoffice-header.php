<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>EquipRent - BackOffice</title>

    <link
        rel="stylesheet"
        href="css/backoffice.css"
    >

</head>

<body>

<div class="backoffice">


    <aside class="sidebar">

        <h2 class="logo">
            EquipRent
        </h2>


        <nav>

            <a href="index.php?action=dashboard">
                Tableau de bord
            </a>


            <?php if (
                $_SESSION['utilisateur']['role']
                === 'RESPONSABLE_INVENTAIRE'
            ): ?>


                <a href="index.php?action=equipements">
                    Équipements
                </a>


                <a href="index.php?action=categories">
                    Catégories
                </a>


                <a href="index.php?action=utilisateurs">
                    Utilisateurs
                </a>


                <a href="index.php?action=stock-alerts">
                    Alertes stock
                </a>


                <a href="index.php?action=search-equipements">
                    Recherche
                </a>


            <?php elseif (
                $_SESSION['utilisateur']['role']
                === 'AGENT_LOCATION'
            ): ?>


                <a href="index.php?action=locations">
                    Locations
                </a>


            <?php endif; ?>


            <a
                class="logout"
                href="index.php?action=logout"
            >
                Déconnexion
            </a>

        </nav>

    </aside>


    <main class="main-content">