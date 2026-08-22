<?php
/** @var int $nombreEquipements */
/** @var int $nombreCategories */
/** @var int $nombreClients */
/** @var int $locationsEnAttente */
/** @var int $stocksFaibles */

require __DIR__
    . '/../layouts/backoffice-header.php';
?>


<div class="topbar">

    <div>

        <h1>
            Tableau de bord
        </h1>

    </div>


    <div class="user-info">

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

    </div>

</div>


<div class="cards">


    <div class="card">

        <h3>
            Équipements
        </h3>

        <div class="number">
            <?= $nombreEquipements ?>
        </div>

    </div>


    <div class="card">

        <h3>
            Catégories
        </h3>

        <div class="number">
            <?= $nombreCategories ?>
        </div>

    </div>


    <div class="card">

        <h3>
            Clients
        </h3>

        <div class="number">
            <?= $nombreClients ?>
        </div>

    </div>


    <div class="card">

        <h3>
            Locations en attente
        </h3>

        <div class="number">
            <?= $locationsEnAttente ?>
        </div>

    </div>


    <div class="card">

        <h3>
            Stocks faibles
        </h3>

        <div class="number">
            <?= $stocksFaibles ?>
        </div>

    </div>


</div>


<?php

require __DIR__
    . '/../layouts/backoffice-footer.php';

?>