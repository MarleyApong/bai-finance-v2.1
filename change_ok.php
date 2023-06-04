<?php
    session_start();
    error_reporting(0);
    if ($_SESSION['OK'] != "ok") {
        header("Location: ../index.php?msg=Vous n'êtes pas autorisé à procédure !");
    }

    if (isset($_POST['submit'])) {
        session_destroy();
        header('location: index.php');
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
    <link rel="stylesheet" href="style/all.css">
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
                <h4>Mot de passe changé </h4>
            </div>
            <div class="Success">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="Input_box">
                <button name="submit" class="ok">ok</button>
            </div>
        </form>
    </div>
</body>

</html>