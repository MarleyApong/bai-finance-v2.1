<?php
    session_start();
    $Idc = $_SESSION['ID'];
    include "bd_cnx.php";
    $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
    $sql->execute(array($Idc));
    $data = $sql->fetch();
    $NomUser = $data['NOM'];
    // $ID_CLT = $data['IDCLT'];

    // recuperation des anciennes informations pour l'update
    $Sele = $database->prepare("SELECT * FROM compte WHERE IDCLT = ?  ORDER BY IDTY_CPTE");
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
    // creation de l'id operation
    $Id_op = substr($NomUser, 0, 1) . substr(time() + 907564, 2, 10);
    $ID_CPTE_EP = $sldep['IDCPTE'];
    $ID_CPTE_TN = $sldtn['IDCPTE'];
    $ID_CPTE_AN = $sldan['IDCPTE'];

    // recuperation du libelle du typde de compte et son id
    $Type_op = $database->query("SELECT * FROM type_operation");
    $tab_idty_op = array();
    $tab_leb_op = array();
    while ($ft = $Type_op->fetch()) {
        $tab_idty_op[] = $ft['IDTY_OP'];
        $tab_leb_op[] = $ft['LIBELLEOP'];
    }

    // compte epargne

    if (isset($_POST['confirm'])) {
        $Pass = $_POST['Take_pass'];
        // recuperation de la  derniere ligne
        $Tab_dmd = $database->prepare("SELECT * FROM demande_rt WHERE IDCLT = ? ORDER BY ID_DMD DESC LIMIT 1");
        $Tab_dmd->execute(array($Idc));
        $Last_id = $Tab_dmd->fetch();

        
        if ($Pass != "") {
            if (password_verify($Pass,$data['PASS'])) {
                // operation de retrait reussie
                $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                $retrait->execute(array($Last_id['NOUVEAU_SD'], $ty[0], $Idc));
                $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDCLT,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $Oper->execute(array($Id_op, $ID_CPTE_EP, $Idc, $tab_idty_op[3], $tab_leb_op[3], $Last_id['MONTANT'], $Date));
                $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
                $demande->execute(array('Ok',$Date,$Idc,$Last_id['ID_DMD']));

                if ($retrait && $Oper && $demande) {
                    echo "RETRAIT D'UN MONTANT DE '".$Last_id['MONTANT']."' FCFA \n";
                    echo "DU COMPTE 'EPARGNE' EFFECTUE AVEC SUCCES !\n";
                    echo "ID DU COMPTE '".$ID_CPTE_EP."' \n";
                    echo "ANCIEN SOLDE ' ".$Last_id['ANCIEN_SD']." '\n";
                    echo "NOUVEAU SOLDE ' ".$Last_id['NOUVEAU_SD']." '\n";
                    echo "DATE DU RETRAIT '".$Date." '";
                }
                else {
                    echo "ERREUR!\n";
                    echo "UN PROBLEME EMPECHE LA CONTINUITE DU RETRAIT\n";
                    echo "VEUILLEZ SVP CONTACTER L'ADMINISTRATEUR";
                }
            }
            else {
                // operation de retrait annulee
                $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
                $demande->execute(array('Annule',$Date,$Idc,$Last_id['ID_DMD']));
                echo "RETRAIT ANNULE !\n";
                echo "MOT DE PASSE INCORRECT.";
            }
        }
        else {
            // operation de retrait annulee
            $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
            $demande->execute(array('Annule',$Date,$Idc,$Last_id['ID_DMD']));
            echo "RETRAIT ANNULE !\n";
            echo "CHAMP MOT DE PASSE VIDE.";
        }
    }
    else if (isset($_POST['confirm2'])) {
        // Compte tontine
        $Pass = $_POST['Take_pass2'];
        // recuperation de la  derniere ligne
        $Tab_dmd = $database->prepare("SELECT * FROM demande_rt WHERE IDCLT = ? ORDER BY ID_DMD DESC LIMIT 1");
        $Tab_dmd->execute(array($Idc));
        $Last_id = $Tab_dmd->fetch();

        if ($Pass != "") {
            if (password_verify($Pass,$data['PASS'])) {
                // operation de retrait reussie
                $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                $dd = $retrait->execute(array($Last_id['NOUVEAU_SD'], $ty[1], $Idc));
                $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDCLT,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $op = $Oper->execute(array($Id_op, $ID_CPTE_TN, $Idc, $tab_idty_op[3], $tab_leb_op[3], $Last_id['MONTANT'], $Date));
                $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
                $demande->execute(array('Ok',$Date,$Idc,$Last_id['ID_DMD']));
                if ($retrait && $Oper && $demande) {
                    echo "RETRAIT D'UN MONTANT DE '".$Last_id['MONTANT']."' FCFA \n";
                    echo "DU COMPTE 'TONTINE' EFFECTUE AVEC SUCCES !\n";
                    echo "ID DU COMPTE '".$ID_CPTE_TN."' \n";
                    echo "ANCIEN SOLDE ' ".$Last_id['ANCIEN_SD']." '\n";
                    echo "NOUVEAU SOLDE ' ".$Last_id['NOUVEAU_SD']." '\n";
                    echo "DATE DU RETRAIT '".$Date." '";
                }
                else {
                    echo "ERREUR!\n";
                    echo "UN PROBLEME EMPECHE LA CONTINUITE DU RETRAIT\n";
                    echo "VEUILLEZ SVP CONTACTER L'ADMINISTRATEUR";
                }
            }
            else {
                // operation de retrait annulee
                $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
                $demande->execute(array('Annule',$Date,$Idc,$Last_id['ID_DMD']));
                echo "RETRAIT ANNULE !\n";
                echo "MOT DE PASSE INCORRECT.";
            }
        }
        else {
            // operation de retrait annulee
            $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
            $demande->execute(array('Annule',$Date,$Idc,$Last_id['ID_DMD']));
            echo "RETRAIT ANNULE !\n";
            echo "CHAMP MOT DE PASSE VIDE.";
        }
    }
    // Compte Annuel
    else if (isset($_POST['confirm3'])) {
        $Pass = $_POST['Take_pass3'];
        // recuperation de la  derniere ligne
        $Tab_dmd = $database->prepare("SELECT * FROM demande_rt WHERE IDCLT = ? ORDER BY ID_DMD DESC LIMIT 1");
        $Tab_dmd->execute(array($Idc));
        $Last_id = $Tab_dmd->fetch();

        if ($Pass != "") {
            if (password_verify($Pass,$data['PASS'])) {
                // operation de retrait reussie
                $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                $dd = $retrait->execute(array($Last_id['NOUVEAU_SD'], $ty[2], $Idc));
                $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDCLT,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $op = $Oper->execute(array($Id_op, $ID_CPTE_AN, $Idc, $tab_idty_op[3], $tab_leb_op[3], $Last_id['MONTANT'], $Date));
                $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
                $demande->execute(array('Ok',$Date,$Idc,$Last_id['ID_DMD']));
                if ($retrait && $Oper && $demande) {
                    echo "RETRAIT D'UN MONTANT DE '".$Last_id['MONTANT']."' FCFA \n";
                    echo "DU COMPTE 'ANNUEL' EFFECTUE AVEC SUCCES !\n";
                    echo "ID DU COMPTE '".$ID_CPTE_AN."' \n";
                    echo "ANCIEN SOLDE ' ".$Last_id['ANCIEN_SD']." '\n";
                    echo "NOUVEAU SOLDE ' ".$Last_id['NOUVEAU_SD']." '\n";
                    echo "DATE DU RETRAIT '".$Date." '";
                }
                else {
                    echo "ERREUR!\n";
                    echo "UN PROBLEME EMPECHE LA CONTINUITE DU RETRAIT\n";
                    echo "VEUILLEZ SVP CONTACTER L'ADMINISTRATEUR";
                }
            }
            else {
                // operation de retrait annulee
                $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
                $demande->execute(array('Annule',$Date,$Idc,$Last_id['ID_DMD']));
                echo "RETRAIT ANNULE !\n";
                echo "MOT DE PASSE INCORRECT.";
            }
        }
        else {
            // operation de retrait annulee
            $demande = $database->prepare("UPDATE demande_rt SET ETAT = ?, DATE_RP = ? WHERE IDCLT = ? AND ID_DMD = ?");
            $demande->execute(array('Annule',$Date,$Idc,$Last_id['ID_DMD']));
            echo "RETRAIT ANNULE !\n";
            echo "CHAMP MOT DE PASSE VIDE.";
        }
    }
?>