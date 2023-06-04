<?php
    session_start();
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../../index.php');
    }else {
        $IDAG = $_SESSION['IDAG'];

        include "../../config/bd_cnx.php";
        $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
        $sql->execute(array($IDAG));
        $data = $sql->fetch();
        $NomUser = $data['NOMEMP'];
        $Avatar = $data['PROFIL'];

        $id = $_GET['id'];
        $Checkemp = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $Checkemp->execute(array($id));
        $Call = $Checkemp->fetch();
        $photo = $Call['PROFIL'];

        if (isset($_POST['submit'])) {

            // on affecte les champs aux variales
            $Nom = htmlspecialchars(ucfirst(strtolower($_POST['Nom'])));
            $Prenom = htmlspecialchars(ucfirst(strtolower($_POST['Prenom'])));
            $Genre = htmlspecialchars(ucfirst(strtolower($_POST['Genre'])));
            $DateNais = htmlspecialchars($_POST['Date-Nais']);
            $LieuNais = htmlspecialchars(ucfirst(strtolower($_POST['Lieu-Nais'])));
            $Profession = htmlspecialchars(ucfirst(strtolower($_POST['Profession'])));
            // $Pays = htmlspecialchars(ucfirst(strtolower($_POST['Pays'])));
            $Ville = htmlspecialchars(ucfirst(strtolower($_POST['Ville'])));
            $Qtier = htmlspecialchars(ucfirst(strtolower($_POST['Qtier'])));
            $Phone = htmlspecialchars($_POST['Phone']);
            $Email = htmlspecialchars($_POST['Email']);
            $Directory = $_POST['Directory'];
            $Message = "";


            $sql = $database->query("UPDATE client SET NOM = '$Nom', PRENOM = '$Prenom', SEXE = '$Genre', DATENAIS = '$DateNais' , LIEUNAIS = '$LieuNais', PROFESSION = '$Profession', VILLE = '$Ville', QUARTIER = '$Qtier', TEL = '$Phone', EMAIL = '$Email', PROFIL = '$photo' WHERE IDCLT = '$id'");

            if (isset($Directory)) {
                switch ($Directory) {
                    case '1':
                        header('location: liste_client.php');
                        break;
                    case '2':
                        header('location: ajout_client.php');
                        break;
                    default:
                        header('location: gestion_client.php');
                        break;
                }
            } else {
                header('location: liste_client.php');
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = 'Infos client';
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../style/compte/compte.css">
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
                            <h3>Modifier le client : 
                                <?php echo $Call['NOM'] . " ";
                                echo $Call['PRENOM']; ?>
                            </h3>
                        </div>
                    </div>

                    <!-- modal form edit -->
                    <?php
                        require_once '../../include/edit_modal_client.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- nav_bottom -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../../js/script.js"></script>
    <script src="../../../js/call_avatar.js"></script>
    <!-- <script src="../../../js/check_input.js"></script> -->
</body>

</html>