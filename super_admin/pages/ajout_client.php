<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
    include_once '../../include/client_save2.php';
?>

<?php
    include_once '../../include/client_save2.php';
    $msg = $_GET['msg'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Ajout client";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../../admin/style/compte/compte.css">
    <link rel="stylesheet" href="../../admin/styles/ajout_client.css">
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

            <?php
                require_once '../../include/modal_form_client.php';
            ?>
        </div>
    </div>
    <!-- bottom bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/chk_int.js"></script>
    <script src="../../js/call_avatar.js"></script>
</body>

</html>