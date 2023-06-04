<?php
    require_once '../include/authentification.php';
    $msg = $_GET['msg'];
    include_once '../../include/client_save.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = 'Ajouer client';
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../../style/formHeader.css">
    <!-- <link rel="stylesheet" href="../style/compte/compte.css"> -->
    <!-- <link rel="stylesheet" href="../../../style/bottom_bar.css"> -->
    <link rel="stylesheet" href="../styles/ajout_client.css">
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
            <div class="Form__container content__padding">
                <div class="Form">
                    <div class="Form__header">
                        <a href= "gestion_client.php" class="Path">
                            <i class="fa-solid fa-mail-reply"></i>
                            <small>retour</small>
                        </a>
                        <div class="Title">
                            <h3>Ajouter un client</h3>
                        </div>
                    </div>

                    <!-- modal form -->
                    <?php
                        require_once '../../include/modal_form_client.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
   <!-- nav_bottom -->
   <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/call_avatar.js"></script>
    <script src="../../js/chk_int.js"></script>
</body>

</html>