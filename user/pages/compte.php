<!-- authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Compte";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/compte/compte.css">
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

            <div class="Form__header">
                <div class="Title">
                    <h3>Comptes</h3>
                </div>
            </div>

            <div class="Content Content__padding">
                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <div class="Box__description">
                            <p>Compte Epargne</p>
                            <button class="Box__link Bl1">Dérouler</button>
                            <p>

                            </p>
                        </div>
                    </div>
                    <div class="Box_call Bx1">
                        <ol class="Slide_menu">
                            <li>
                                <a href="../retrait/retrait.php">1.Retrait</a>
                            </li>
                            <li>
                                <a href="../recharge/recharge.php">2.Recharge</a>
                            </li>
                            <li>
                                <a href="">3.Payement</a>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>
                        <div class="Box__description">
                            <p>Compte Tontine</p>
                            <button class="Box__link Bl2">Dérouler</button>
                            <p></p>
                        </div>
                    </div>
                    <div class="Box_call Bx2">
                        <ol class="Slide_menu">
                            <li>
                                <a href="../retrait/retrait.php">1.Retrait</a>
                            </li>
                            <li>
                                <a href="../recharge/recharge.php">2.Recharge</a>
                            </li>
                            <li>
                                <a href="">3.Payement</a>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="Box">
                    <div class="Box_default">
                        <div class="Box__icon">
                            <i class="fa-solid fa-hourglass-2"></i>
                        </div>
                        <div class="Box__description">
                            <p>Compte Annuel</p>
                            <button class="Box__link Bl3">Dérouler</button>
                            <p></p>
                        </div>
                    </div>
                    <div class="Box_call Bx3">
                        <ol class="Slide_menu">
                            <li>
                                <a href="../retrait/retrait.php">1.Retrait</a>
                            </li>
                            <li>
                                <a href="../recharge/recharge.php">2.Recharge</a>
                            </li>
                            <li>
                                <a href="">3.Payement</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom_bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/box_call.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        setInterval('load_msg()', 1000);
        function load_msg() {
            $('#popup').load('../../config/confirm_pass.php');
        }
    </script>
</body>

</html>