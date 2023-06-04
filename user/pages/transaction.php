<!-- authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Transaction";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/transaction.css">
    <link rel="stylesheet" href="../../style/box.css">
</head>

<body>
    <div class="Top">
        <!-- nav -->
        <?php
            require_once '../include/navigation.php';
        ?>
        <div class="Main">
            <!-- top_bar -->
            <?php
                require_once '../include/topbar.php';
            ?>

            <div class="Content Content__padding">
                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-list-1-2"></i>
                        </div>
                        <div class="Box__description">
                            <p>Liste des transactions</p>
                            <a href="liste_transaction.php" class="Box__link Bl1">Afficher</a>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-exchange"></i>
                        </div>
                        <div class="Box__description">
                            <p>Effectuer une transaction</p>
                            <a href="go_transaction.php" class="Box__link Bl2">Effectuer</a>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-line-chart"></i>
                        </div>
                        <div class="Box__description">
                            <p>Détails et opération du compte</p>
                            <button class="Box__link Bl3">Consulter</button>
                            <p></p>
                        </div>
                    </div>
                    <div class="Box_call Bx3">
                        <ol class="Slide_menu">
                            <li>
                                <a href="compte_epargne.php">1.Compte Epargne</a>
                            </li>
                            <li>
                                <a href="compte_tontine.php">2.Compte Tontine</a>
                            </li>
                            <li>
                                <a href="compte_annuel.php">3.Compte Annuel</a>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- bottom_bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/box_call.js"></script>
</body>

</html>