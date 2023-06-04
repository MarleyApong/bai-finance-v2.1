<!-- Authentification -->
<?php
require_once '../include/authentification.php';
$msg = $_GET['msg'];
?>


<?php
if (isset($_POST['submit'])) {

    // on affecte les champs aux variales
    $Nom = htmlspecialchars(ucfirst(strtolower($_POST['Nom'])));
    $Prenom = htmlspecialchars(ucfirst(strtolower($_POST['Prenom'])));
    $Genre = htmlspecialchars(ucfirst(strtolower($_POST['Genre'])));
    $DateNais = htmlspecialchars($_POST['Date-Nais']);
    $LieuNais = htmlspecialchars(ucfirst(strtolower($_POST['Lieu-Nais'])));
    $Profession = htmlspecialchars(ucfirst(strtolower($_POST['Profession'])));
    $Idpers = htmlspecialchars(strtoupper($_POST['Id-pers']));
    // $Pays = htmlspecialchars(ucfirst(strtolower($_POST['Pays'])));
    $Ville = htmlspecialchars(ucfirst(strtolower($_POST['Ville'])));
    $Qtier = htmlspecialchars(ucfirst(strtolower($_POST['Qtier'])));
    $Phone = htmlspecialchars($_POST['Phone']);
    $Email = htmlspecialchars($_POST['Email']);
    $EtatCpte = htmlspecialchars(ucfirst(strtolower($_POST['Etat-Cpte'])));
    $DateEmb = htmlspecialchars($_POST['Date-Emb']);
    $Pass = htmlspecialchars($_POST['Pass']);
    $Statut = htmlspecialchars(ucfirst(strtolower($_POST['Statut'])));
    $Directory = $_POST['Directory'];
    $Message = "";

    $check = $database->prepare("SELECT `IDEMP` FROM `employe` WHERE IDEMP = ?");
    $check->execute(array($Idpers));
    $data = $check->fetch();
    $row = $check->rowCount();

    if (isset($_FILES['Profil']) and !empty($_FILES['Profil']['name'])) {
        $SizeMax = 3145728;
        $FileName = strtolower($_FILES['Profil']['name']);
        $Extension = pathinfo($FileName, PATHINFO_EXTENSION);
        $AllExtension = array('png', 'jpg', 'jpeg');

        if ($_FILES['Profil']['size'] <= $SizeMax) {
            if (in_array($Extension, $AllExtension)) {
                $ProfilName = file_get_contents($_FILES['Profil']['tmp_name']);

                if ($row == 0) {
                    if (!$Pass == "") {
                        $cost = ['cost' => 12];
                        $NewPass = password_hash("$Pass", PASSWORD_BCRYPT, $cost);

                        $Object = new DateTime();
                        $Object->setTimezone(new DateTimeZone('Africa/Douala'));
                        $DateCreat = $Object->format("Y-m-d h:i:s");

                        $sql = $database->prepare('INSERT INTO `employe` (`IDEMP`, `NOMEMP`, `PRENOMEMP`, `SEXEEMP`, `DATENAISEMP`, `LIEUNAIS`, `PROFESSION`, `VILLE`, `QUARTIER`, `TEL`, `EMAIL`, `PASS`, `STATUT`, `ETATCPTE`, `DATEEMB`, `DATECREAT`, `PROFIL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                        $sql->execute(array($Idpers, $Nom, $Prenom, $Genre, $DateNais, $LieuNais, $Profession, $Ville, $Qtier, $Phone, $Email, $NewPass, $Statut, $EtatCpte, $DateEmb, $DateCreat, $ProfilName));
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
                        }
                    }
                } else {
                    header("location: ajout_admin.php?msg=Un empployé utilise déjà cet ID");
                }
            } else {
                header("location: ajout_admin.php?msg=La photo doit être à l'un des formats : jpg, jpeg, png !");
            }
        } else {
            header('location: ajout_admin.php?msg=La photo ne doit pas dépasser 1 Mo !');
        }
    } else {
        if ($row == 0) {
            if (!$Pass == "") {
                $cost = ['cost' => 12];
                $NewPass = password_hash("$Pass", PASSWORD_BCRYPT, $cost);

                $DateCreat = date("y-m-d h:i:s");
                $sql = $database->prepare('INSERT INTO `employe` (`IDEMP`, `NOMEMP`, `PRENOMEMP`, `SEXEEMP`, `DATENAISEMP`, `LIEUNAIS`, `PROFESSION`, `VILLE`, `QUARTIER`, `TEL`, `EMAIL`, `PASS`, `STATUT`, `ETATCPTE`, `DATEEMB`, `DATECREAT`, `PROFIL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, null)');
                $sql->execute(array($Idpers, $Nom, $Prenom, $Genre, $DateNais, $LieuNais, $Profession, $Ville, $Qtier, $Phone, $Email, $NewPass, $Statut, $EtatCpte, $DateEmb, $DateCreat));
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
                }
            }
        } else {
            echo "ID déja présent !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    $Title = "Ajout admin/agent";
    require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../style/ajout_admin.css">
    <!-- <link rel="stylesheet" href="../../style/Tableau_de_bord.css"> -->
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
                        <a href="gestion_client.php" class="Path">
                            <i class="fa-solid fa-mail-reply"></i>
                            <small>retour</small>
                        </a>
                        <div class="Title">
                            <h3>Ajouter un Personnel</h3>
                        </div>
                    </div>

                    <form id="Form" class="Add__scrollY" method="POST" enctype="multipart/form-data">
                        <div class="Identity">

                            <div class="Identity__header">
                                <div class="Important">
                                    <span></span>
                                    <h4> NB : Les champs obligatoires apparaissent en <span class="Red">rouge</span>.
                                    </h4><br>
                                    <span class="msg"><?=$msg?></span>
                                </div>
                            </div>

                            <div class="Identity__content">
                                <div class="Name__group">
                                    <h3>Identité</h3>
                                </div>
                                <div class="First__group">
                                    <div class="Profil">
                                        <img src="../../img/profil/placeholder.png" alt="avatar" id="Avatar">
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
                                        <input type="text" id="Nom" name="Nom" maxlength="30" autocomplete="off" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Prenom">Prenom : </label>
                                        <input type="text" id="Prenom" name="Prenom" maxlength="20" autocomplete="off" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Genre">Genre : </label>
                                        <select name="Genre" id="Genre">
                                            <option value="">non spécifié</option>
                                            <option value="F">Femme</option>
                                            <option value="H">Homme</option>
                                        </select>
                                        <small class="Message_err"></small>

                                    </div>

                                    <div class="Input__box">
                                        <label for="Date-Nais">Date de naissance : </label>
                                        <input type="date" id="Date-Nais" name="Date-Nais" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Lieu-Nais">Lieu naissance : </label>
                                        <input type="text" id="Lieu-Nais" name="Lieu-Nais" maxlength="20" autocomplete="off" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Profession">Profession : </label>
                                        <input type="text" id="Profession" name="Profession" maxlength="20" autocomplete="off" />
                                        <small class="Message_err"></small>
                                    </div>

                                    <div class="Input__box" style="display: none;">
                                        <label for="Id-pers">Id Personnel : </label>
                                        <input type="text" id="Id-pers" name="Id-pers" maxlength="9" desable autocomplete="off" />
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
                                    <input type="text" id="Ville" name="Ville" maxlength="15" autocomplete="off" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Qtier">Quartier : </label>
                                    <input type="text" id="Qtier" name="Qtier" maxlength="15" autocomplete="off" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Phone">Téléphone : </label>
                                    <input type="number" id="Phone" name="Phone" maxlength="13" autocomplete="off" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Email">Email : </label>
                                    <input type="text" id="Email" name="Email" maxlength="30" autocomplete="off" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Date-Emb">Date Embauche : </label>
                                    <input type="date" id="Date-Emb" name="Date-Emb" autocomplete="off" />
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
                                    <label for="Compte">Compte : </label>
                                    <select name="Etat-Cpte" id="Etat-Cpte">
                                        <option value="Actif">Actif</option>
                                        <option value="Inactif">Inactif</option>
                                    </select>
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Password">Mot de passe : </label>
                                    <input type="password" name="Pass" id="Password" />
                                    <small class="Message_err"></small>
                                </div>
                                <div class="Input__box">
                                    <label for="Statut">Statut : </label>
                                    <select name="Statut" id="Statut">
                                        <option value="Agent">Agent</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                    <small class="Message_err"></small>
                                </div>
                            </div>

                            <div class="Save__and__Other">
                                <div class="Before__Save">
                                    <label for="Directory">Après la création de l'employé :</label>
                                    <select name="Directory" id="Directory">
                                        <option value="1">Aller à la liste des employés [action par defaut]</option>
                                        <option value="2">Ajouter un nouveau employés</option>
                                        <!-- <option value="3">Afficher l'employé</option> -->
                                        <option value="4">Aller à la page principale</option>
                                    </select>
                                </div>
                                <div class="Login__button">
                                    <button type="submit" name="submit">
                                        <i class="fa-solid fa-save"></i>
                                        <span>Enregistrer</span>
                                    </button>
                                    <a href="liste_admin.php">
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
    <script src="../../js/check_input2.js"></script>
</body>

</html>