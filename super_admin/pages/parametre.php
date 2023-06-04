<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Paramètre";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../style/parametre.css">
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

                    <div class="Add__scrollY" method="POST" id="Form">
                        <div class="Identity">
                            <div class="Identity__content">
                                <div class="Name__group">
                                    <h3>Identité</h3>
                                </div>
                                <div class="First__group">
                                    <div class="Profil">
                                        <img src="data:image;base64,<?=base64_encode($Avatar)?>"/>
                                        <input type="file" />
                                    </div>
                                </div>

                                <form id="Prof" class="Secondly__group">
                                    <div class="Input__box">

                                        <div class="Input__box">
                                            <label for="Profession">Profession : </label>
                                            <input type="text" id="Profession" name="Profession" value="<?php echo $data['PROFESSION']; ?>" />
                                        </div>

                                        <div class="Login__button">
                                            <button name="save_prof" id="save_prof">
                                                <i class="fa-solid fa-save"></i>
                                                <span>Enregistrer</span>
                                            </button>
                                        </div>
                                        <small class="Message_err"></small>
                                    </div>
                                </form>
                            </div>

                            <form id="Contact" method="POST" class="Contact__info">
                                <div class="Info__first Name__group">
                                    <h3>Informations de contact</h3>
                                </div>
                                
                                <div class="Info__secondly">
                                    <div class="Input__box">
                                        <label for="Ville">Ville : </label>
                                        <input type="text" id="Ville" name="Ville" maxlength="15" autocomplete="none" value="<?php echo $data['VILLE']; ?>" />
                                        <small class="Message_err"></small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Qtier">Quartier : </label>
                                        <input type="text" id="Qtier" name="Qtier" maxlength="15" autocomplete="none" value="<?php echo $data['QUARTIER']; ?>" />
                                        <!-- <small class="Message_err"></small> -->
                                    </div>
                                    <div class="Input__box">
                                        <label for="Phone">Téléphone : </label>
                                        <input type="text" id="Phone" name="Phone" maxlength="13" autocomplete="none" value="<?php echo $data['TEL']; ?>" />
                                    </div>
                                    <div class="Input__box">
                                        <label for="Email">Email : </label>
                                        <input type="text" id="Email" name="Email" maxlength="30" autocomplete="none" value="<?php echo $data['EMAIL']; ?>" />
                                        <!-- <small class="Message_err"></small> -->
                                    </div>
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Login__button">
                                    <button name="save_contact" id="save_contact">
                                        <i class="fa-solid fa-save"></i>
                                        <span>Enregistrer</span>
                                    </button>
                                </div>
                            </form>
                            
                            <div class="Confidence">
                                <div class="Confidence__first Name__group">
                                    <h3>Modifier votre mot de passe</h3>
                                </div>
                                
                                <form id="Security" method="POST" class="Confidence__secondly">
                                    <div class="Input__box">
                                        <label for="Last_pass">Ancien mot de passe : </label>
                                        <input type="password" name="Last_pass" id="Last_pass" />
                                    </div>
                                    <div class="Input__box">
                                        <label for="New_Pass">Nouveau Mot de passe : </label>
                                        <input type="password" name="New_Pass" id="New_Pass" />
                                    </div>
                                    <div class="Config_pass pass">
                                        <label for="">Confirmer mot de passe : </label>
                                        <input type="password" name="Config_pass" id="Config_pass" />
                                    </div>
                                    <small class="Message_err"></small>
                                    <div class="Login__button">
                                        <button name="save_pass" id="save_pass">
                                            <i class="fa-solid fa-save"></i>
                                            <span>Enregistrer</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
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
        <script src="../../js/jquery-3.6.1.js"></script>
        <script>
        $(document).ready(() => {
            $("#save_prof").click(() => {
                let Profession = $("#Profession").val();
                $.ajax({
                    type: 'POST',
                    url: '../../../config/ajax_param_ad.php',
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
                    url: '../../../config/ajax_param_ad.php',
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
                    url: '../../../config/ajax_param_ad.php',
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