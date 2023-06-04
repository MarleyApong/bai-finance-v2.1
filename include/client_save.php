<?php
// include "../config/bd_cnx.php";

if (isset($_POST['submit'])) {

    // on affecte les champs aux variales
    $Nom = htmlspecialchars(ucfirst(strtolower($_POST['Nom'])));
    $Prenom = htmlspecialchars(ucfirst(strtolower($_POST['Prenom'])));
    $Genre = htmlspecialchars(ucfirst(strtolower($_POST['Genre'])));
    $DateNais = htmlspecialchars($_POST['Date-Nais']);
    $LieuNais = htmlspecialchars(ucfirst(strtolower($_POST['Lieu-Nais'])));
    $Profession = htmlspecialchars(ucfirst(strtolower($_POST['Profession'])));
    $Idclt = htmlspecialchars(strtoupper($_POST['Id-clt']));
    // $Pays = htmlspecialchars(ucfirst(strtolower($_POST['Pays'])));
    $Ville = htmlspecialchars(ucfirst(strtolower($_POST['Ville'])));
    $Qtier = htmlspecialchars(ucfirst(strtolower($_POST['Qtier'])));
    $Phone = htmlspecialchars($_POST['Phone']);
    $Email = htmlspecialchars($_POST['Email']);
    $EtatCpte = htmlspecialchars(ucfirst(strtolower($_POST['Etat-Cpte'])));
    $Pass = htmlspecialchars($_POST['Pass']);

    $ch1 = isset($_POST['Chk1']) ? "checked" : "unchecked";
    $ch2 = isset($_POST['Chk2']) ? "checked" : "unchecked";
    $ch3 = isset($_POST['Chk3']) ? "checked" : "unchecked";

    @$Chk1 = $_POST['Chk1'];
    @$Chk2 = $_POST['Chk2'];
    @$Chk3 = $_POST['Chk3'];
    $SodeE = $_POST['SodeE'];
    $SodeT = $_POST['SodeT'];
    $SodeA = $_POST['SodeA'];

    $Directory = $_POST['Directory'];

    // Hachage du mot de passe 
    $Cost = ['cost' => 12];
    $NewPass = password_hash("$Pass", PASSWORD_BCRYPT, $Cost);
    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('Africa/Douala'));
    $Date = $Object->format("Y-m-d H:i:s");

    $tm = time();
    $dt = date('ymd');
    $IDcpt = $dt + $tm;
    $IDcpte = substr($IDcpt, 0, 9) + 3;
    $IDcptt = substr($IDcpt, 0, 9) + 5;
    $IDcptn = substr($IDcpt, 0, 9) + 9;
    $IDep = strval(320 . substr($IDcpte, 0, 2) . substr($IDcpt, 6, 10));
    $IDtn = strval(230 . substr($IDcpte, 0, 2) . (substr($IDcpt, 6, 10) + 3));
    $IDan = strval(420 . substr($IDcpte, 0, 2) . (substr($IDcpt, 6, 10) + 4));

    $NomtyE = "Epargne";
    $NomtyT = "Tontine";
    $NomtyA = "Annuel";

    $Directory = $_POST['Directory'];

    $check = $database->prepare("SELECT `IDCLT` FROM `client` WHERE IDCLT = ?");
    $check->execute(array($Idclt));
    $data = $check->fetch();
    $row = $check->rowCount();

    // Miration des cles de differents
    $CheckAgence = $database->query("SELECT * FROM `banque`");
    // $CheckTycpt = $database->query("SELECT * FROM ``");
    while ($DataAgence = $CheckAgence->fetch()) {
?>
<?php $IDagence = $DataAgence['IDBQ']; ?>
<?php
    }

    // Verification du profil
    if (isset($_FILES['Profil']) and !empty($_FILES['Profil']['name'])) {
        $SizeMax = 1048566;
        $FileName = strtolower($_FILES['Profil']['name']);
        $Extension = pathinfo($FileName, PATHINFO_EXTENSION);
        $AllExtension = array('png', 'jpg', 'jpeg');

        if ($_FILES['Profil']['size'] != 0 && $_FILES['Profil']['size'] < $SizeMax) {
            if (in_array($Extension, $AllExtension)) {
                $ProfilName = file_get_contents($_FILES['Profil']['tmp_name']);

                if ($row == 0) {
                    $query2 = $database->query('SELECT * FROM `type_compte` ');

                    $Idty = array();
                    $Nomtty = array();
                    while ($ty = $query2->fetch()) {
                        $Idty[] = $ty['IDTY_CPTE'];
                        $Nomtty[] = $ty['NOMTYPE'];
                    }

                    $sql = $database->prepare('INSERT INTO `client` (`IDCLT`, `NOM`, `PRENOM`, `SEXE`, `DATENAIS`, `LIEUNAIS`, `PROFESSION`, `VILLE`, `QUARTIER`, `TEL`, `EMAIL`, `PASS`, `ETATCPTE`, `DATECREAT`, `PROFIL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $sql->execute(array($Idclt, $Nom, $Prenom, $Genre, $DateNais, $LieuNais, $Profession, $Ville, $Qtier, $Phone, $Email, $NewPass, $EtatCpte, $Date, $ProfilName));

                    if ($ch1 == "checked") {
                        $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array($IDep, $IDagence, $Idclt, $Idty[0], $Nomtty[0], $SodeE, $Date));
                    } else {
                        $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array($IDep, $IDagence, $Idclt, $Idty[0], $Nomtty[0], 0, $Date));
                    }
                    if ($ch2 == "checked") {
                        $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array($IDtn, $IDagence, $Idclt, $Idty[1], $Nomtty[1], $SodeT, $Date));
                    } else {
                        $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array($IDtn, $IDagence, $Idclt, $Idty[1], $Nomtty[1], 0, $Date));
                    }
                    if ($ch3 == "checked") {
                        $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array($IDan, $IDagence, $Idclt, $Idty[2], $Nomtty[2], $SodeA, $Date));
                    } else {
                        $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                        $query->execute(array($IDan, $IDagence, $Idclt, $Idty[2], $Nomtty[2], 0, $Date));
                    }

                    if (isset($Directory)) {
                        switch ($Directory) {
                            case '1':
                                header('location: ../../../admin/pages/liste_client.php');
                                break;
                            case '2':
                                header('location: ../../../admin/pages/ajout_client.php');
                                break;
                            case '3':
                                header('location: ');
                                break;
                            default:
                                header('location: ../../../admin/pages/gestion_client.php');
                                break;
                        }
                    } else {
                        header('location: ../../../admin/pages/liste_client.php');
                    }
                } else {
                    echo "Id existant !";
                }
            } else {
                header("location: ../../../admin/pages/ajout_client.php?msg=La photo doit être à l'un des formats : jpg, jpeg, png !");
            }
        } else {
            header('location: ../../../admin/pages/ajout_client.php?msg=La photo ne doit pas dépasser 1 Mo !');
        }
    } else {
        if ($row == 0) {
            if (!$Pass == "") {
                $cost = ['cost' => 12];
                $NewPass = password_hash("$Pass", PASSWORD_BCRYPT, $cost);
                $Date = date("y-m-d h:i:s");
                $query2 = $database->query('SELECT * FROM `type_compte` ');

                $Idty = array();
                $Nomtty = array();
                while ($ty = $query2->fetch()) {
                    $Idty[] = $ty['IDTY_CPTE'];
                    $Nomtty[] = $ty['NOMTYPE'];
                }

                $sql = $database->prepare('INSERT INTO `client` (`IDCLT`, `NOM`, `PRENOM`, `SEXE`, `DATENAIS`, `LIEUNAIS`, `PROFESSION`, `VILLE`, `QUARTIER`, `TEL`, `EMAIL`, `PASS`, `ETATCPTE`, `DATECREAT`, `PROFIL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, null)');
                $sql->execute(array($Idclt, $Nom, $Prenom, $Genre, $DateNais, $LieuNais, $Profession, $Ville, $Qtier, $Phone, $Email, $NewPass, $EtatCpte, $Date));

                if ($ch1 == "checked") {
                    $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $query->execute(array($IDep, $IDagence, $Idclt, $Idty[0], $Nomtty[0], $SodeE, $Date));
                } else {
                    $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $query->execute(array($IDep, $IDagence, $Idclt, $Idty[0], $Nomtty[0], 0, $Date));
                }
                if ($ch2 == "checked") {
                    $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $query->execute(array($IDtn, $IDagence, $Idclt, $Idty[1], $Nomtty[1], $SodeT, $Date));
                } else {
                    $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $query->execute(array($IDtn, $IDagence, $Idclt, $Idty[1], $Nomtty[1], 0, $Date));
                }
                if ($ch3 == "checked") {
                    $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $query->execute(array($IDan, $IDagence, $Idclt, $Idty[2], $Nomtty[2], $SodeA, $Date));
                } else {
                    $query = $database->prepare('INSERT INTO `compte` (`IDCPTE`, `IDAG`, `IDCLT`, `IDTY_CPTE`, `TYPE`, `SOLDE`, `DATECREATE`) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $query->execute(array($IDan, $IDagence, $Idclt, $Idty[2], $Nomtty[2], 0, $Date));
                }

                if (isset($Directory)) {
                    switch ($Directory) {
                        case '1':
                            header('location: ../../../admin/pages/liste_client.php');
                            break;
                        case '2':
                            header('location: ../../../admin/pages/ajout_client.php');
                            break;
                        case '3':
                            header('location: ../../../admin/pages/');
                            break;
                        default:
                            header('location: ../../../admin/pages/gestion_client.php');
                            break;
                    }
                } else {
                    header('location: ../../../admin/pages/liste_client.php');
                }
            }
        } else {
            echo "ID déja présent !";
        }
    }
}
?>