<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Gestion de compte";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/box.css">
    <link rel="stylesheet" href="../style/gestion_compte.css">
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
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="Box__description">
                            <p>Liste des comptes</p>
                            <button class="Box__link Bl1">Dérouler</button>
                            <p>

                            </p>
                        </div>
                    </div>
                    <div class="Box_call Bx1">
                        <ol class="Slide_menu">
                            <li>
                                <a href="epargne.php">1.Epargne</a>
                            </li>
                            <li>
                                <a href="tontine.php">2.Tontine</a>
                            </li>
                            <li>
                                <a href="annuel.php">3.Annuel</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-list-1-2"></i>
                        </div>
                        <div class="Box__description">
                            <p>Liste des clients</p>
                            <a href="liste_client.php" class="Box__link Bl2">Lister</a>
                            <p>

                            </p>
                        </div>
                    </div>
                    <div class="Box_call Bx2">
                    </div>
                </div>


                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <div class="Box__description">
                        <p>Gestion des comptes clients</p>
                        <a href="details_compte.php" class="Box__link">C'est parti </a>
                        <p>

                        </p>
                    </div>
                </div>

                <div class="Boxr">
                    
                </div>

                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <div class="Box__description">
                        <p>Liste des transactions</p>
                        <a href="liste_transaction.php" class="Box__link">C'est parti </a>
                        <p>

                        </p>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box__icon">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <div class="Box__description">
                        <p>Liste des opérations</p>
                        <a href="liste_operation.php" class="Box__link">C'est parti </a>
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
    <script src="../../js/box_call.js"></script>
</body>

</html>