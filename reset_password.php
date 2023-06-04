<?php
session_start();
error_reporting(0);
if ($_SESSION['up'] != 'oui') {
    header('location: index.php');
    session_destroy();
}
include "config/bd_cnx.php";
// Bouton connexion clique
if (isset($_POST['submit'])) {
    // Initialisation des variables
    $Id = htmlspecialchars($_POST['Id_connexion']);
    $Datenais = htmlspecialchars($_POST['Datenais']);

    $User = "BU";
    $Admin = "BA";

    $cost = ['cost' => 12];
    $NewPass = password_hash("$Pass", PASSWORD_BCRYPT, $cost);

    if (substr($Id,0,2) == $User) {
        $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $sql->execute(array($Id));
        $data = $sql->fetch();
        if ($data && $data['DATENAIS'] == $Datenais) {
            $_SESSION['ID'] = $data['IDCLT'];
            $_SESSION['CHANGE'] = "oui";
            header("Location: change_pass.php");
        } else {
            header('Location: reset_password.php?msg=Mauvais identifiant ou date de naissance !');
        }
    } elseif (substr($Id,0,2) == $Admin) {
        $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
        $sql->execute(array($Id));
        $data = $sql->fetch();
        if ($data && $data['DATENAIS'] == $Datenais) {
            if ($data['STATUT'] == "Admin") {
                $_SESSION['Autoriser'] = "oui";
                $_SESSION['ID'] = $data['IDEMP'];
                header("Location: change_pass.php");
            } else {
                $_SESSION['Autoriser'] = "oui";
                $_SESSION['ID'] = $data['IDEMP'];
                header("Location: change_pass.php");
            }
        } else {
            header('Location: reset_password.php?msg=Mauvais identifiant ou date de naissance !');
        }
    }
    else {
        header('Location: reset_password.php?msg=Mauvais identifiant ou date de naissance !');
    }
}
$msg = $_GET['msg'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo/logo_title.png" type="image/x-icon">

    <title>BAI FINANCE reset password</title>
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
                <h4>Reset password </h4>
            </div>

            <!-- ======================Champs d'informations -->
            <div class="Input_box">
                <input type="text" name="Id_connexion" placeholder="Votre Identifiant" id="Id_connexion" autocomplete="none">
            </div>

            <div class="Input_box">
                <!-- <label for="Datenais">Date naissance</label> -->
                <input type="date" name="Datenais" placeholder="Votre date de naissance" id="Datenais">
            </div>

            <div class="Input_box Box_sbmt" style="display: flex; justify-content:center;align-items:center;gap:10px;">
                <a href="index.php">Annuler</a>
                <button type="submit" name="submit">Vérifier</button>
            </div>

            <div class="Input_box">
                <small class="Message_err"><?= $msg ?></small>
            </div>
        </form>
    </div>
   <script>
    // Initialisation des variables
        let Form = document.getElementById("Form");
        let Id = document.getElementById("Id_connexion");
        let Date = document.getElementById("Datenais");
        let Message = "";

        Form.addEventListener('submit', e => {
            let IdValue = Id.value.trim();
            let Datev = Date.value;

            // check dun id
            if (IdValue == "") {
                Message = "Entrez votre Identifiant !";
                M_Error(Message);
                e.preventDefault();
            }
            else if (Datev == "") {
                Message = "Entrez votre date de naissance !";
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