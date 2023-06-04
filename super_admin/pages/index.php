<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Tableau de bord";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/Tableau_de_bord.css">
    <link rel="stylesheet" href="../../admin/styles/admin_bord.css">
    <link rel="stylesheet" href="../../style/box.css">
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

            <div class="Title_party">
                <h4>Tableau de bord</h4>
            </div>
            <div class="Widget1">
                <div class="Card">
                    <i class="fa-solid fa-user"></i>
                    <span>
                        <small>Total client :</small>
                        <small>
                            <?php
                                $count = $database->query("SELECT IDCLT FROM client");
                                $Totalclit = $count->rowCount();
                            ?>
                            <?=$Totalclit?>
                        </small>
                    </span>
                </div>
                <div class="Card">
                    <i class="fa-brands fa-grav"></i>
                    <span>
                        <small>Total Employé :</small>
                        <small> 
                            <?php
                                $count = $database->query("SELECT IDEMP FROM employe");
                                $Totalemp = $count->rowCount();
                            ?>
                            <?=$Totalemp?>
                        </small>
                    </span>
                </div>
                <div class="Card">
                    <i class="fa-solid fa-handshake"></i>
                    <span>
                        <small>Revenu du mois : </small>
                        <small>32000 fcfa</small>
                    </span>
                </div>
                <div class="Card">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                    <span>
                        <small>Total transaction : </small>
                        <small> 
                            <?php
                                $count = $database->query("SELECT ID_TRANS FROM transaction");
                                $Totaltr = $count->rowCount();
                            ?>
                            <?=$Totaltr?>
                        </small>
                    </span>
                </div>
            </div>

            <div class="Content Content__paddin">
                <div class="Name_group">
                    Détails activités
                </div>
                <div class="Widget2">
                    <div class="Box">
                        <i class="fa-solid fa-cash-register"></i>
                        <span>
                            <small>Total Dépôt : </small>
                            <small>
                                <?php
                                    $count = $database->query("SELECT IDOP FROM operation WHERE LIBELLEOP = 'Depot'");
                                    $Totaldp = $count->rowCount();
                                ?>
                                <?=$Totaldp?>
                            </small>
                        </span>
                    </div>
                    <div class="Box">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                        <span>
                            <small>Total Retrait : </small>
                            <small>
                                <?php
                                    $count = $database->query("SELECT IDOP FROM operation WHERE LIBELLEOP = 'Retrait'");
                                    $Totalre = $count->rowCount();
                                ?>
                                <?=$Totalre?>
                            </small>
                        </span>
                    </div>
                    <div class="Box">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <span>
                            <small>Total opération : </small>
                            <small>
                                <?php
                                    $count = $database->query("SELECT IDOP FROM operation");
                                    $Totalop = $count->rowCount();
                                ?>
                                <?=$Totalop?>
                            </small>
                        </span>
                    </div>
                    <div class="Box">
                        <i class="fa-solid fa-wheelchair-alt"></i>
                        <span>
                            <small>Demande de Prêt : </small>
                            <small>
                                <?php
                                    $count = $database->query("SELECT IDPRET FROM pret");
                                    $Totalpr = $count->rowCount();
                                ?>
                                <?=$Totalpr?>
                            </small>
                        </span>
                    </div>
                    <div class="Box">
                        <i class="fa-solid fa-check-double"></i>
                        <span>
                            <small>Demande de Prêt traitée : </small>
                            <small>
                                <?php
                                    $count = $database->query("SELECT IDPRET FROM pret");
                                    $Totalpr = $count->rowCount();
                                ?>
                                <?=$Totalpr?>
                            </small>
                        </span>
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