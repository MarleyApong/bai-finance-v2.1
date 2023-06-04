<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = 'Gestion client';
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../styles/gestion_client.css">
    <link rel="stylesheet" href="../../style/box.css">
    <link rel="stylesheet" href="../../styles/splecial.css">
</head>

<body>
    <div class="Top">
         <!-- nav -->
         <?php
            require_once '../include/navigation.php';
        ?>

        <div class="Main">
            <!-- topbar -->
           <?php
                require_once '../include/topbar.php';
           ?>

            <div class="Middle__help">
                <a href= "index.php" class="Path">
                    <i class="fa-solid fa-mail-reply"></i>
                    <small>retour</small>
                </a>
            </div>

            <div class="Content Content__padding">
                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="Box__description">
                        <p>Ajouter un client</p>
                        <a href="ajout_client.php" class="Box__link">Ajouter</a>
                        <p></p>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-list-alt"></i>
                    </div>
                    <div class="Box__description">
                        <p>Liste des clients</p>
                        <a href="liste_client.php" class="Box__link">Voir liste</a>
                        <p></p>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <div class="Box__description">
                        <p>Gestion des comptes</p>
                        <a href="gestion_compte.php" class="Box__link">C'est parti </a>
                        <p>

                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- nav_bottom -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../../js/script.js"></script>
</body>

</html>