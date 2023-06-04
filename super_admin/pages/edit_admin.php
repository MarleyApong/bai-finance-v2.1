<?php
session_start();
if ($_SESSION['Autoriser'] != "oui") {
    header('Location: ../index.php');
} else {
    $IDAD = $_SESSION['IDEMP'];

    include "../../config/bd_cnx.php";
    // echo($NomUser);
    $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
    $sql->execute(array($IDAD));
    $data = $sql->fetch();
    $NomUser = $data['NOMEMP'];
    $Avatar = $data['PROFIL'];

    $id = $_GET['id'];
    $Checkemp = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
    $Checkemp->execute(array($id));
    $Call = $Checkemp->fetch();

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
        $Statut = htmlspecialchars(ucfirst(strtolower($_POST['Statut'])));
        $Directory = $_POST['Directory'];
        $Message = "";


        $sql = $database->query("UPDATE employe SET NOMEMP = '$Nom', PRENOMEMP = '$Prenom', SEXEEMP = '$Genre', DATENAISEMP = '$DateNais' , LIEUNAIS = '$LieuNais', PROFESSION = '$Profession', VILLE = '$Ville', QUARTIER = '$Qtier', TEL = '$Phone', EMAIL = '$Email', STATUT = '$Statut', PROFIL = '$Avatar' WHERE IDEMP = '$id'");

        if (isset($Directory)) {
            switch ($Directory) {
                case '1':
                    header('location: liste_admin.php');
                    break;
                case '2':
                    header('location: ajout_admin.php');
                    break;
                case '3':
                    header('location: /');
                    break;
                default:
                    header('location: gestion_admin.php');
                    break;
            }
        } else {
            header('location: liste_admin.php');
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Modifier admin/agent";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../style/ajout_admin.css">
</head>

<body>
    <div class="Top">
        <!-- topbar -->
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
                        <a href="liste_admin.php" class="Path">
                            <i class="fa-solid fa-mail-reply"></i>
                            <small>retour</small>
                        </a>
                        <div class="Title">
                            <h3>Modifier l'employé : <?php echo $Call['NOMEMP'] . " ";
                                                        echo $Call['PRENOMEMP']; ?></h3>
                        </div>
                    </div>

                    <form id="Form" class="Add__scrollY" method="POST" enctype="multipart/form-data">
                        <div class="Identity">

                            <div class="Identity__content">
                                <div class="Name__group">
                                    <h3>Identité</h3>
                                </div>
                                <div class="First__group">
                                    <div class="Profil">
                                        <img src="../../img/profil/<?php echo $Call['PROFIL']; ?>" alt="avatar" id="Avatar">
                                    </div>
                                    <div class="Caracteristic">
                                        <div class="Input__box">
                                            <input type="file" id="Profil" name="Profil" />
                                        </div>
                                        <div class="Input__box">
                                            <small><?php echo (@$Message); ?></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="Secondly__group">
                                    <div class="Input__box">
                                        <label for="Nom">Nom : </label>
                                        <input type="text" id="Nom" name="Nom" maxlength="30" autocomplete="none" value="<?php echo $Call['NOMEMP']; ?>" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Prenom">Prenom : </label>
                                        <input type="text" id="Prenom" name="Prenom" maxlength="20" autocomplete="none" value="<?php echo $Call['PRENOMEMP']; ?>" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Genre">Genre : </label>
                                        <input type="text" name="Genre" value="<?php echo $Call['SEXEEMP']; ?>" />
                                        <small class="Message_err"></small>

                                    </div>

                                    <div class="Input__box">
                                        <label for="Date-Nais">Date de naissance : </label>
                                        <input type="date" id="Date-Nais" name="Date-Nais" value="<?php echo $Call['DATENAISEMP']; ?>" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Lieu-Nais">Lieu naissance : </label>
                                        <input type="text" id="Lieu-Nais" name="Lieu-Nais" maxlength="20" autocomplete="none" value="<?php echo $Call['LIEUNAIS']; ?>" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Profession">Profession : </label>
                                        <input type="text" id="Profession" name="Profession" maxlength="20" autocomplete="none" value="<?php echo $Call['PROFESSION']; ?>" />
                                        <small class="Message_err"></small>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="Contact__info">
                            <div class="Info__first Name__group">
                                <h3>Informations de contact</h3>
                            </div>

                            <div class="Info__secondly">
                                <div class="Input__box">
                                    <label for="Ville">Ville : </label>
                                    <input type="text" id="Ville" name="Ville" maxlength="15" autocomplete="none" value="<?php echo $Call['VILLE']; ?>" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Qtier">Quartier : </label>
                                    <input type="text" id="Qtier" name="Qtier" maxlength="15" autocomplete="none" value="<?php echo $Call['QUARTIER']; ?>" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Phone">Téléphone : </label>
                                    <input type="text" id="Phone" name="Phone" maxlength="13" autocomplete="none" value="<?php echo $Call['TEL']; ?>" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Email">Email : </label>
                                    <input type="text" id="Email" name="Email" maxlength="30" autocomplete="none" value="<?php echo $Call['EMAIL']; ?>" />
                                    <small class="Message_err"></small>
                                </div>
                            </div>
                        </div>

                        <div class="Confidence">
                            <div class="Confidence__first Name__group">
                                <h3>Confidentialité & Sécurité</h3>
                            </div>

                            <div class="Confidence__secondly">
                                <div class="Input__box">
                                    <label for="Statut">Statut : </label>
                                    <select name="Statut" id="Statut">
                                        <option value="<?php echo $Call['STATUT']; ?>"><?php echo $Call['STATUT']; ?></option>
                                        <option value="Agent">Agent</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                    <small class="Message_err"></small>
                                </div>
                            </div>

                            <div class="Save__and__Other">
                                <div class="Before__Save">
                                    <label for="Directory">Après la modification de l'employé :</label>
                                    <select name="Directory" id="Directory">
                                        <option value="1">Aller à la liste des employés [action par defaut]</option>
                                        <option value="2">Ajouter un nouveau employés</option>
                                        <option value="3">Afficher l'employé</option>
                                        <option value="4">Aller à la page principale</option>
                                    </select>
                                </div>
                                <div class="Login__button">
                                    <button name="submit">
                                        <i class="fa-solid fa-save"></i>
                                        <span>Modifier</span>
                                    </button>
                                    <a href="../ressource_humaine/liste_admin.php">
                                        <i class="fa-solid fa-list-1-2"></i>
                                        <span>Liste employé(s)</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- bottom bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/call_avatar.js"></script>
    <!-- <script src="../../js/check_input2.js"></script> -->
</body>

</html>