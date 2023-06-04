<?php
    session_start();
    error_reporting(0);
    $_SESSION['up'] = 'oui';
    include "config/bd_cnx.php";
    // Bouton connexion clique
    if (isset($_POST['submit'])) {
        // Initialisation des variables
        $Id = htmlspecialchars($_POST['Id_connexion']);
        $Pass = htmlspecialchars($_POST['Pwd_connexion']);

        $User = "BU";
        $Admin = "BA";
        $First = $Id[0];
        $Second = $Id[1];

        $cost = ['cost' => 12];
        $NewPass = password_hash("$Pass", PASSWORD_BCRYPT,$cost);

        $Conca = strval($First) . strval($Second);
        if ($Conca == $User) {
            try {
                $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
                $sql->execute(array($Id));
                $data = $sql->fetch();
                if($data && password_verify($Pass,$data['PASS'] )) {
                    if ($data['ETATCPTE'] == "Actif") {
                        $_SESSION['ID'] = $data['IDCLT'];
                        $_SESSION['Autoriser'] = "oui";
                        header('Location: user/pages/index.php');
                    }
                    else {
                        header("Location: index.php?msg=Vous avez été bloqué(e) par l'administrateur !");
                    }
                } else {
                    header('Location: index.php?msg=Mauvais identifiant ou mot de passe !');
                }
            } catch (PDOException $e) {
                die("Echec de la connexion : " . $e->getMessage());
                exit();
            }
        }
        elseif ($Conca == $Admin) {
            $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
            $sql->execute(array($Id));
            $data = $sql->fetch();
            if($data && password_verify($Pass,$data['PASS'] )) {
                if ($data['STATUT'] == "Admin") {
                    $_SESSION['Autoriser'] = "oui";
                    $_SESSION['IDEMP'] = $data['IDEMP'];
                    header('Location: super_admin/pages/index.php');
                } else {
                    if ($data['ETATCPTE'] == "Actif") {
                        $_SESSION['Autoriser'] = "oui";
                        $_SESSION['IDAG'] = $data['IDEMP'];
                        header('Location: admin/pages/index.php');
                    }
                    else {
                        header("Location: index.php?msg=Vous avez été bloqué(e) par l'administrateur !");
                    }
                }
                    
            }else {
                header('Location: index.php?msg=Mauvais identifiant ou mot de passe !');
            }
        }
        else{
            header('Location: index.php?msg=Mauvais identifiant ou mot de passe !');
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

    <title>BAI FINANCE connexion</title>
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
            <div class="Logo_e">
                <img src="img/logo/logo_phone.jpg" alt="">
            </div>
            <div class="NamePage">
                <h4>Connexion</h4>
            </div>

            <!-- ======================Champs d'informations -->
            <div class="Input_box">
                <input type="text" name="Id_connexion" placeholder="Votre Identifiant" id="Nom_connexion" autocomplete="none">
            </div>

            <div class="Input_box">
                <input type="password" name="Pwd_connexion" placeholder="Votre mot de passe" id="Pwd_connexion">
            </div>

            <div class="Input_box Box_sbmt">
                <button type="submit" name="submit">Se connecter</button>
            </div>

            <div class="Input_box">
                <small class="Message_err"><?=$msg?></small>
                <a href="reset_password.php">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
    <script src="js/check_cnx.js"></script>
</body>

</html>