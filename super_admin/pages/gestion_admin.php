<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Gestion admin";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/box.css">
    <link rel="stylesheet" href="../style/gestion_admin.css">
    <link rel="stylesheet" href="../../admin/styles/splecial.css">
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

            <!-- middle -->
            <?php
                require_once '../include/middle.php';
            ?>

            <div class="Content Content__padding">
                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="Box__description">
                        <p>Ajouter un admin</p>
                        <a href="ajout_admin.php" class="Box__link">Ajouter</a>
                        <p></p>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-list-alt"></i>
                    </div>
                    <div class="Box__description">
                        <p>Liste des admins</p>
                        <a href="liste_admin.php" class="Box__link">Voir liste</a>
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
    <!-- bottom bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
</body>

</html>