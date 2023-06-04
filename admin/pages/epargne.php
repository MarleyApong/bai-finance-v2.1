<!-- authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = 'Gestion des comptes : Epargne';
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../styles/epargne.css">
</head>

<body>
    <div class="Top">
        <!-- nav -->
        <?php
            require_once '../include/navigation.php';
        ?>

        <div class="Main">
            <?php
                require_once '../include/topbar.php';
           ?>

            <div class="Middle__help">
                <div class="Help__img">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="Help__content">
                    <p>Echangez avec un de nos Experts de Groupe BBP</p>
                </div>
                <div class="Help__link">
                    <a href="">Aide ?</a>
                </div>
            </div>

            <div class="Form__container content__padding">
                <div class="Form">
                    <div class="Form__header">
                        <div class="Title">
                            <h3>Compte Epargne</h3>
                        </div>
                    </div>

                    <form class="Add__scrollY" action="" method="POST">
                        <div class="Info_cpte">
                            <div class="General">
                                <div class="Date_cpte">
                                    <?php
                                    $DtNow = date('d/m/Y');
                                    ?>
                                    <span>Date d'aujourd'hui <?php echo $DtNow; ?></span>
                                </div>
                                <div class="Details_cpte">
                                    <div class="Logo_cpte">
                                        <i class="fa-solid fa-leaf"></i>
                                    </div>
                                    <div class="Name_cpte">
                                        <span>Solde Total : </span>
                                        <?php
                                        $CheckTotal = $database->query("SELECT SUM(SOLDE) FROM `compte`,`client` WHERE compte.IDCLT = client.IDCLT AND IDCPTE LIKE '3%' ");
                                        if ($CheckTotal->rowCount() > 0) {
                                            while ($DataTotal = $CheckTotal->fetch()) {
                                                echo $DataTotal['SUM(SOLDE)'];
                                            }
                                        } else {
                                            echo  0;
                                        }

                                        ?>
                                        fcfa
                                    </div>
                                    <div class="Gain_cpte">
                                        <span>Revenu du compte du : </span>
                                        <span>0 fcfa</span>
                                    </div>
                                </div>
                            </div>
                            <div class="Detail">
                                <div class="Title">
                                    <h3>Compte Epargne</h3>
                                </div>
                                <div class="RecentOrders">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>Id client</td>
                                                <td>Nom</td>
                                                <td>Prenom</td>
                                                <td>Age</td>
                                                <td>Sexe</td>
                                                <td>Id compte</td>
                                                <td>Solde total</td>
                                                <!-- <td>Revenu</td> -->
                                                <td>Date création</td>
                                                <!-- <td>Plus d'infos</td> -->
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $Checkcpt = $database->query("SELECT * FROM `compte`,`client` WHERE compte.IDCLT = client.IDCLT AND IDCPTE LIKE '3%' ");
                                            if ($Checkcpt->rowCount() > 0) {
                                                while ($Datacpt = $Checkcpt->fetch()) {
                                                    if (substr($Datacpt['IDCPTE'], 0, 3) == '320') {
                                                        $TmpDate = substr($Datacpt['DATENAIS'], 0, 4);
                                                        $DateNow = date('Y');
                                                        $Age = strval($DateNow) - strval($TmpDate)
                                            ?>
                                                        <tr>
                                                            <td><?php echo $Datacpt['IDCLT']; ?></td>
                                                            <td><?php echo $Datacpt['NOM']; ?></td>
                                                            <td><?php echo $Datacpt['PRENOM']; ?></td>
                                                            <td><?php echo $Age; ?></td>
                                                            <td><?php echo $Datacpt['SEXE']; ?></td>
                                                            <td><?php echo $Datacpt['IDCPTE']; ?></td>
                                                            <td><?php echo $Datacpt['SOLDE']; ?></td>
                                                            <!-- <td><?php echo $Datacpt['IDCPTE']; ?></td> -->
                                                            <td><?php echo $Datacpt['DATECREATE']; ?></td>
                                                            <!-- <td><i class="fa-solid fa-chart-line"></i></td> -->
                                                        </tr>
                                                <?php

                                                    }
                                                }
                                            } else {
                                                ?>
                                                <p>Aucun client</p>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="Login__button">
                            <a href="tontine.php">
                                <i class="fa-solid fa-handshake"></i>
                                <span>Compte Tontine</span>
                            </a>
                            <a href="annuel.php">
                                <i class="fa-solid fa-hourglass-2"></i>
                                <span>Compte Annuel</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- nav_bottom -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../../js/script.js"></script>
    <!-- <script src="../../../js/box_call.js"></script> -->
</body>

</html>