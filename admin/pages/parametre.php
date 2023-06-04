<!-- authentification -->
<?php
require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    $Title = 'Paramètre';
    require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../styles/parametre.css">
    <link rel="stylesheet" href="../../style/box.css">
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
                        <div class="Title">
                            <h3>Paramètre</h3>
                        </div>
                    </div>

                    <!-- modal form -->
                    <?php
                    require_once '../../include/modal_parametre.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom bar -->
    <?php
    require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <!-- <script src="../../js/call_avatar.js"></script> -->
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(() => {
            $("#save_avatar").click(() => {
                let Profil = $("#Profil").val();
                $.ajax({
                    type: 'POST',
                    url: '../../../config/ajax_param_ag.php',
                    data: {
                        Profil: Profil
                    },
                    success: (Response) => {
                        alert(Response);
                    }
                })
            })

            $("#save_prof").click(() => {
                let Profession = $("#Profession").val();
                $.ajax({
                    type: 'POST',
                    url: '../../../config/ajax_param_ag.php',
                    data: {
                        Profession: Profession
                    },
                    success: (Response) => {
                        alert(Response);
                    }
                })
            })

            $("#save_contact").click(() => {
                let Ville = $("#Ville").val();
                let Qtier = $("#Qtier").val();
                let Phone = $("#Phone").val();
                let Email = $("#Email").val();

                $.ajax({
                    type: 'POST',
                    url: '../../../config/ajax_param_ag.php',
                    data: {
                        Ville: Ville,
                        Qtier: Qtier,
                        Phone: Phone,
                        Email: Email
                    },
                    success: (Response) => {
                        alert(Response);
                    }
                })

            })

            $('#save_pass').click(() => {
                let Last_pass = $("#Last_pass").val();
                let New_Pass = $("#New_Pass").val();
                let Config_pass = $("#Config_pass").val();

                $.ajax({
                    type: 'POST',
                    url: '../../../config/ajax_param_ag.php',
                    data: {
                        Last_pass: Last_pass,
                        New_Pass: New_Pass,
                        Config_pass: Config_pass,
                    },
                    success: (Response) => {
                        alert(Response);
                    }
                })
            })
        })
    </script>
</body>

</html>