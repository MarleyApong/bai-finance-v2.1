<?php
     session_start();
     $IdC = $_SESSION['ID'];
     include 'bd_cnx.php';
    $Confirm_pass = $database->prepare("SELECT * FROM demande_rt WHERE IDCLT = ? ORDER BY ID_DMD DESC LIMIT 1");
    $Confirm_pass->execute(array($IdC));
    while ($C_etat = $Confirm_pass->fetch()) {
        if ($C_etat['TYPE_CPTE'] == 'Epargne') {
            if ($C_etat['ETAT'] == 'Attente') {
                ?>
                    <script>
                        let confirm = '';
                        // $(".popup").css("transform","translateY(0px)");
                        let Take_pass = prompt("Entrer votre mot de passe pour finaliser le retrait");
                            $.ajax ({
                            type: 'POST',
                            url: '../../config/ajax_confirm.php',
                            data: {'Take_pass': Take_pass,confirm:confirm},
                            success:  (Response) => {
                                alert(Response);
                            }
                        })
                    </script>
                <?php
            }
        }
        else if ($C_etat['TYPE_CPTE'] == 'Tontine') {
            if ($C_etat['ETAT'] == 'Attente') {
                ?>
                    <script>
                        let confirm2 = '';
                        // $(".popup").css("transform","translateY(0px)");
                        let Take_pass2 = prompt("Entrer votre mot de passe pour finaliser le retrait");
                            $.ajax ({
                            type: 'POST',
                            url: '../../config/ajax_confirm.php',
                            data: {'Take_pass2': Take_pass2,confirm2:confirm2},
                            success:  (Response) => {
                                alert(Response);
                            }
                        })
                    </script>
                <?php
            }
        }
        else {
            if ($C_etat['ETAT'] == 'Attente') {
                ?>
                    <script>
                        let confirm3 = '';
                        // $(".popup").css("transform","translateY(0px)");
                        let Take_pass3 = prompt("Entrer votre mot de passe pour finaliser le retrait");
                            $.ajax ({
                            type: 'POST',
                            url: '../../config/ajax_confirm.php',
                            data: {'Take_pass3': Take_pass3,confirm3:confirm3},
                            success:  (Response) => {
                                alert(Response);
                            }
                        })
                    </script>
                <?php
            }
        }
        
    }
?>