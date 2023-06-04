<?php
session_start();
error_reporting(0);
if ($_SESSION['Autoriser'] != "oui") {
    header('Location: ../../../index.php');
} else {
    $IDAG = $_SESSION['IDAG'];

    include "../config/bd_cnx.php";
    $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
    $sql->execute(array($IDAG));
    $data = $sql->fetch();
    $NomUser = $data['NOMEMP'];
    $Avatar = $data['PROFIL'];
}
?>

<?php

if (isset($_POST['search_id'])) {
    if (isset($_POST['search']) || !empty($_POST['search'])) {
        $_SESSION['Idc'] = $_POST['search_text'];
        $Clt = $database->prepare("SELECT * FROM compte WHERE IDCLT = ? ORDER BY IDTY_CPTE");
        $Clt->execute(array($_SESSION['Idc']));
        $Found = $Clt->rowCount();
        $bool = 0;
        if ($_SESSION['Idc'] != "") {
            if ($Found > 0) {
                echo "Id trouvé !";
                $bool = 1;
            } else {
                echo "Id non trouvé !";
                $bool = 0;
            }
        } else {
            echo "";
        }
    }
}


$Idc = $_SESSION['Idc'];
$Client = $database->query("SELECT NOM FROM client WHERE IDCLT = '$Idc'");
$Verif = $Client->fetch();
if (isset($_POST['select'])) {
    if ($_POST['ss'] != "") {
        $Sele = $database->prepare("SELECT * FROM compte WHERE IDCLT = ? ORDER BY IDTY_CPTE");
        $Sele->execute(array($Idc));
?>
        <label for="Type_cpt">Selectionner le compte : </label>
        <select name="Type_cpt" id="Type_cpt">
            <option value="">--</option>
            <?php
            while ($Che = $Sele->fetch()) {
                echo '<option value="' . $Che['TYPE'] . '">' . $Che['TYPE'] . '</option>';
            }
            ?>
        </select>
        <small class="Error">Choisissez le compte</small>
<?php
    }
}

$Sele = $database->prepare("SELECT * FROM compte WHERE IDCLT = ? ORDER BY IDTY_CPTE");
$Sele->execute(array($Idc));
$ty = array();
while ($Check = $Sele->fetch()) {
    $ty[] = $Check['TYPE'];
}
$Ch = $database->prepare("SELECT * FROM compte WHERE TYPE = ? and IDCLT = ?");
$Ch2 = $database->prepare("SELECT * FROM compte WHERE TYPE = ? and IDCLT = ?");
$Ch3 = $database->prepare("SELECT * FROM compte WHERE TYPE = ? and IDCLT = ?");
$Ch->execute(array($ty[0], $Idc));
$Ch2->execute(array($ty[1], $Idc));
$Ch3->execute(array($ty[2], $Idc));
$sldep = $Ch->fetch();
$sldtn = $Ch2->fetch();
$sldan = $Ch3->fetch();
$Object = new DateTime();
$Object->setTimezone(new DateTimeZone('Africa/Douala'));
$Date = $Object->format("Y-m-d H:i:s");
$Id_op = substr($NomUser, 0, 1) . substr(time() + 907564, 2, 10);
$ID_CPTE_EP = $sldep['IDCPTE'];
$ID_CPTE_TN = $sldtn['IDCPTE'];
$ID_CPTE_AN = $sldan['IDCPTE'];

$Type_op = $database->query("SELECT * FROM type_operation");
$tab_idty_op = array();
$tab_leb_op = array();
while ($ft = $Type_op->fetch()) {
    $tab_idty_op[] = $ft['IDTY_OP'];
    $tab_leb_op[] = $ft['LIBELLEOP'];
}


if (isset($_POST['depot'])) {
    if ($_POST['select'] == "Epargne") {
        $Ancien_sd = $sldep['SOLDE'];
        $Nw_sd = $Ancien_sd + strval($_POST['montant']);
        $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
        $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDCLT,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $op = $Oper->execute(array($Id_op, $ID_CPTE_EP, $Idc, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
        $dd = $depot->execute(array($Nw_sd, $ty[0], $Idc));
        if ($dd && $op) {
            echo "Dépot de " . $_POST['montant'] . " FCFA EFFECTUE\n";
            echo "AVEC SUCCES DANS LE COMPTE EPARGNE \n";
            echo "DU CLIENT ' " . $Verif['NOM'] . "' !";
        } else {
            echo "DEPOT NON EFFECTUE !";
        }
    } else if ($_POST['select'] == "Tontine") {
        $Ancien_sd = $sldtn['SOLDE'];
        $Nw_sd = $Ancien_sd + strval($_POST['montant']);
        $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
        $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDCLT,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $Oper->execute(array($Id_op, $ID_CPTE_TN, $Idc, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
        $depot->execute(array($Nw_sd, $ty[1], $Idc));
        if ($depot && $Oper) {
            echo "Dépot de " . $_POST['montant'] . " FCFA EFFECTUE\n";
            echo "AVEC SUCCES DANS LE COMPTE TONTINE \n";
            echo "DU CLIENT ' " . $Verif['NOM'] . "' !";
        } else {
            echo "DEPOT NON EFFECTUE !";
        }
    } else if ($_POST['select'] == "Annuel") {
        $Ancien_sd = $sldan['SOLDE'];
        $Nw_sd = $Ancien_sd + strval($_POST['montant']);
        $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
        $depot->execute(array($Nw_sd, $ty[2], $Idc));
        $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDCLT,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $Oper->execute(array($Id_op, $ID_CPTE_AN, $Idc, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
        if ($depot && $Oper) {

            echo "Dépot de " . $_POST['montant'] . " FCFA EFFECTUE\n";
            echo "AVEC SUCCES DANS LE COMPTE ANNUEL \n";
            echo "DU CLIENT ' " . $Verif['NOM'] . "' !";
        } else {
            echo "DEPOT NON EFFECTUE !";
        }
    }
}
if (isset($_POST['retrait'])) {
    // if (password_verify($Pass, $data['PASS'])) {
    if ($_POST['select'] == "Epargne") {
        $Ancien_sd = $sldep['SOLDE'];
        $Nw_sd = $Ancien_sd - strval($_POST['montant']);
        if ($Ancien_sd >= $_POST['montant']) {
            if ($Nw_sd > 1000) {
                
                // operation de retrait inseree dans la table demande_rt
                $Dmd_req = $database->prepare("INSERT INTO demande_rt (ID_DMD,ID_EMP,IDCLT,TYPE_CPTE,ID_TYPE_CPTE,MONTANT,ANCIEN_SD,NOUVEAU_SD,ETAT,DATE_DMD,DATE_RP) VALUES(null,?,?,?,?,?,?,?,?,?,null)");
                $Dmd_req->execute(array($IDAG, $Idc, $_POST['select'], $ID_CPTE_EP, $_POST['montant'], $Ancien_sd, $Nw_sd, 'Attente', $Date));
                if ($Dmd_req) {
                    echo "DEMANDE RETRAIT ENVOYEE AU CLIENT '". $Verif['NOM']. "'!\n";
                    echo "COMPTE DE L'OPERATION '".$_POST['select']."'\n";
                    echo "EN ATTENTE DE CONFIRMATION.";
                } else {
                    echo "DEMANDE NON ENVOYE !";
                }
            } else {
                echo "RETRAIT NON EFFECTUE !\n";
                echo "LE SOLDE DU COMPTE NE PEUT ETRE INFERIEUR A 1000 FCFA";
            }
        } else {
            echo "RETRAIT NON EFFECTUE !\n";
            echo "MONTANT DU COMPTE EPARGNE INSUFFISANT !";
        }
    } else if ($_POST['select'] == "Tontine") {
        $Ancien_sd = $sldtn['SOLDE'];
        if ($Ancien_sd > $_POST['montant']) {
            $Nw_sd = $Ancien_sd - strval($_POST['montant']);
            // operation de retrait inseree dans la table demande_rt
            $Dmd_req = $database->prepare("INSERT INTO demande_rt (ID_DMD,ID_EMP,IDCLT,TYPE_CPTE,ID_TYPE_CPTE,MONTANT,ANCIEN_SD,NOUVEAU_SD,ETAT,DATE_DMD,DATE_RP) VALUES(null,?,?,?,?,?,?,?,?,?,null)");
            $Dmd_req->execute(array($IDAG, $Idc, $_POST['select'], $ID_CPTE_TN, $_POST['montant'], $Ancien_sd, $Nw_sd, 'Attente', $Date));
            if ($Dmd_req) {
                echo "DEMANDE RETRAIT ENVOYEE AU CLIENT '". $Verif['NOM']. "'!\n";
                echo "COMPTE DE L'OPERATION '".$_POST['select']."'\n";
                echo "EN ATTENTE DE CONFIRMATION.";
            } else {
                echo "RETRAIT NON EFFECTUE !";
            }
        } else {
            echo "RETRAIT NON EFFECTUE !\n";
            echo "MONTANT DU COMPTE TONTINE INSUFFISANT !";
        }
    } else if ($_POST['select'] == "Annuel") {
        $Ancien_sd = $sldan['SOLDE'];
        if ($Ancien_sd > $_POST['montant']) {
            $Nw_sd = $Ancien_sd - strval($_POST['montant']);
            // operation de retrait inseree dans la table demande_rt
            $Dmd_req = $database->prepare("INSERT INTO demande_rt (ID_DMD,ID_EMP,IDCLT,TYPE_CPTE,ID_TYPE_CPTE,MONTANT,ANCIEN_SD,NOUVEAU_SD,ETAT,DATE_DMD,DATE_RP) VALUES(null,?,?,?,?,?,?,?,?,?,null)");
            $Dmd_req->execute(array($IDAG, $Idc, $_POST['select'], $ID_CPTE_AN, $_POST['montant'], $Ancien_sd, $Nw_sd, 'Attente', $Date));
            if ($Dmd_req) {
                echo "DEMANDE RETRAIT ENVOYEE AU CLIENT '". $Verif['NOM']. "'!\n";
                echo "COMPTE DE L'OPERATION '".$_POST['select']."'\n";
                echo "EN ATTENTE DE CONFIRMATION.";
            } else {
                echo "RETRAIT NON EFFECTUE !";
            }
        } else {
            echo "RETRAIT NON EFFECTUE !\n";
            echo "MONTANT DU COMPTE ANNUEL INSUFFISANT !";
        }
    }
}
