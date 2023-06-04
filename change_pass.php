<?php
    session_start();
    error_reporting(0);
    if ($_SESSION['CHANGE']!= "oui") {
        header("Location: ../index.php?msg=Vous n'êtes pas autorisé à cette procédure !");
    }else {
        $IdC = $_SESSION['ID'];
        require_once 'config/bd_cnx.php';

        if (isset($_POST['submit'])) {
            // Initialisation des variables
            $Pass = htmlspecialchars($_POST['Pass']);
            $Confirm = htmlspecialchars($_POST['Confirm']);
        
            if ($Pass == $Confirm) {
                $cost = ['cost' => 12];
                $NewPass = password_hash("$Pass", PASSWORD_BCRYPT, $cost);
                if (substr($IdC,0,2) == 'BU') {
                    echo $IdC;
                    $statement = $database->prepare("UPDATE client SET PASS = ? WHERE IDCLT = ? ");
                    $statement->execute(array($NewPass,$IdC));
    
                    if ($statement) {
                        $_SESSION['OK'] = "ok";
                        header('location: change_ok.php');
                    }
                } 
                else {
                    $statement = $database->prepare("UPDATE employe SET PASS = ? WHERE IDEMP = ? ");
                    $statement->execute(array($NewPass,$IdC));
                    echo $IdC;
                    if ($statement) {
                        $_SESSION['OK'] = "ok";
                        header('location: change_ok.php');
                    }
                }
            }
        }
        $msg = $_GET['msg'];
    }
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo/logo_title.png" type="image/x-icon">

    <title>BAI FINANCE change password</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="j.js" async></script>
</head>

<body>
    <!-- =====================Partie blanche========== -->
    <div class="Content">
        <!-- =========================Partie pour l'image de gauche================ -->
        <div class="Left">
            <div class="Img"></div>
        </div>

        <!-- =========================Partie de droite[Connexion]=================== -->
        <form id="Form" method="POST" class="Right">
            <!-- =======================Nom de la page==================== -->
            <div class="NamePage">
                <h4>Modification en cours </h4>
            </div>

            <!-- ======================Champs d'informations -->
            <div class="Input_box">
                <input type="password" name="Pass" placeholder="Votre nouveau mot de passe" id="Pass" autocomplete="none">
            </div>

            <div class="Input_box">
                <input type="password" name="Confirm" placeholder="Confirmez mot de passe" id="Confirm">
            </div>

            <div class="Input_box Box_sbmt">
                <button type="submit" name="submit">Rénitialiser</button>
            </div>

            <div class="Input_box">
                <small class="Message_err"><?= $msg ?></small>
            </div>
        </form>
    </div>
   <script>
    // Initialisation des variables
        let Form = document.getElementById("Form");
        let Pass = document.getElementById("Pass");
        let Confirm = document.getElementById("Confirm");
        let Message = "";

        Form.addEventListener('submit', e => {
            let Passv = Pass.value;
            let Confirmv = Confirm.value;

            // check dun id
            if (Passv != Confirmv) {
                Message = "Les mots de passe sont différents !";
                M_Error(Message);
                e.preventDefault();
            }
            else if (Passv.length < 5) {
                Message = "Le mot de passe doit être supérieur ou égale à 5 !";
                M_Error(Message);
                e.preventDefault();
            }
            

            // =============Fonction qui sera retournee en cas d'erreur

            function M_Error(Message) {
                let Small = document.querySelector('small');

                // Retour du message d'erreur 
                Small.innerText = Message;

            }
        })

   </script>
</body>

</html>