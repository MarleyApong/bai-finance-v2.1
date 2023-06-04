<?php
session_start();
error_reporting(0);
if ($_SESSION['Autoriser'] != "oui") {
    header('Location: ../../../index.php');
} 
else {
    $IdC = $_SESSION['ID'];
    include '../config/bd_cnx.php';
    $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
    $sql->execute(array($IdC));
    $data = $sql->fetch();
    $NomUser = $data['NOM'];
    $Avatar = $data['PROFIL'];


    $Clt = $database->prepare("SELECT * FROM compte WHERE IDCLT = ?  ORDER BY IDTY_CPTE");
    $Clt->execute(array($IdC));
    while ($Check = $Clt->fetch()) {
        $ty[] = $Check['TYPE'];
    }
    $Ch = $database->prepare("SELECT * FROM compte WHERE TYPE = ? and IDCLT = ?");
    $Ch2 = $database->prepare("SELECT * FROM compte WHERE TYPE = ? and IDCLT = ?");
    $Ch3 = $database->prepare("SELECT * FROM compte WHERE TYPE = ? and IDCLT = ?");
    $Ch->execute(array($ty[0], $IdC));
    $Ch2->execute(array($ty[1], $IdC));
    $Ch3->execute(array($ty[2], $IdC));
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
            $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?)");
            $op = $Oper->execute(array($Id_op, $ID_CPTE_EP, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
            $dd = $depot->execute(array($Nw_sd, $ty[0], $IdC));
            if ($dd && $op) {
            
                echo "Dépot de ".$_POST['montant']." FCFA EFFECTUE\n"; 
                echo "AVEC SUCCES DANS LE COMPTE EPARGNE !";
            
            } else {
                echo "DEPOT NON EFFECTUE !";
            }
        } else if ($_POST['select'] == "Tontine") {
            $Ancien_sd = $sldtn['SOLDE'];
            $Nw_sd = $Ancien_sd + strval($_POST['montant']);
            $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
            $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?)");
            $Oper->execute(array($Id_op, $ID_CPTE_TN, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
            $depot->execute(array($Nw_sd, $ty[1], $IdC));
            if ($depot && $Oper) {
                echo "DEPOT DE ".$_POST['montant']." FCFA EFFECTUE\n"; 
                echo "AVEC SUCCES DANS LE COMPTE TONTINE !";
            } else {
                echo "DEPOT NON EFFECTUE !";
            }
        } else if ($_POST['select'] == "Annuel") {
            $Ancien_sd = $sldan['SOLDE'];
            $Nw_sd = $Ancien_sd + strval($_POST['montant']);
            $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
            $depot->execute(array($Nw_sd, $ty[2], $IdC));
            $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?)");
            $Oper->execute(array($Id_op, $ID_CPTE_AN, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
            if ($depot && $Oper) {
          
                echo "DEPOT DE ".$_POST['montant']." FCFA EFFECTUE \n";
                echo "AVEC SUCCES DANS LE COMPTE ANNUEL !";
            } else {
                echo "DEPOT NON EFFECTUE !";
            }
        }
    }
    if (isset($_POST['retrait'])) {
        if (password_verify($Pass,$data['PASS'] )) {
            if ($_POST['select'] == "Epargne") {
                $Ancien_sd = $sldep['SOLDE'];
                $Nw_sd = $Ancien_sd - strval($_POST['montant']);
                if ($Ancien_sd >= $_POST['montant']) {
                    if ($Nw_sd > 1000) {
                        $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                        $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?)");
                        $op = $Oper->execute(array($Id_op, $ID_CPTE_EP, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
                        $dd = $retrait->execute(array($Nw_sd, $ty[0], $IdC));
                        if ($dd && $op) {
                            echo "RETRAIT DE ".$_POST['montant']." FCFA EFFECTUE \n";
                            echo "AVEC SUCCES DANS LE COMPTE EPARGNE !";
                        } 
                        else {
                            echo "RETRAIT NON EFFECTUE !";
                        }
                    }
                    else {
                        echo "RETRAIT NON EFFECTUE !\n";
                        echo "LE SOLDE DU COMPTE NE PEUT ETRE INFERIEUR A 1000 FCFA";
                    }
                }
                else {
                    echo "RETRAIT NON EFFECTUE !\n";
                    echo "MONTANT DU COMPTE EPARGNE INSUFFISANT !";
                }
            } else if ($_POST['select'] == "Tontine") {
                $Ancien_sd = $sldtn['SOLDE'];
                if ($Ancien_sd > $_POST['montant']) {
                    $Nw_sd = $Ancien_sd - strval($_POST['montant']);
                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                    $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?)");
                    $Oper->execute(array($Id_op, $ID_CPTE_TN, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
                    $retrait->execute(array($Nw_sd, $ty[1], $IdC));
                    if ($retrait && $Oper) {
                        echo "RETRAIT DE ".$_POST['montant']." FCFA EFFECTUE"; 
                        echo "AVEC SUCCES DANS LE COMPTE TONTINE !";
                    } else {
                        echo "RETRAIT NON EFFECTUE !";
                    }
                }
                else {
                    echo "RETRAIT NON EFFECTUE !\n";
                    echo "MONTANT DU COMPTE TONTINE INSUFFISANT !";
                }
            } else if ($_POST['select'] == "Annuel") {
                $Ancien_sd = $sldan['SOLDE'];
                if ($Ancien_sd > $_POST['montant']) {
                    $Nw_sd = $Ancien_sd - strval($_POST['montant']);
                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                    $retrait->execute(array($Nw_sd, $ty[2], $IdC));
                    $Oper = $database->prepare("INSERT INTO operation (IDOP,IDCPTE,IDTY_OP,LIBELLEOP,MONTANTOP,DATEOP) VALUES(?, ?, ?, ?, ?, ?)");
                    $Oper->execute(array($Id_op, $ID_CPTE_AN, $tab_idty_op[0], $tab_leb_op[0], $_POST['montant'], $Date));
                    if ($retrait && $Oper) {
                        echo "RETRAI DE ".$_POST['montant']." FCFA EFFECTUE \n";
                        echo "AVEC SUCCES DANS LE COMPTE ANNUEL !";
                    } else {
                        echo "RETRAIT NON EFFECTUE !";
                    }
                }
                else {
                    echo "RETRAIT NON EFFECTUE !\n";
                    echo "MONTANT DU COMPTE ANNUEL INSUFFISANT !";
                }
            }
        }
        else {

            echo "MOT DE PASSE INCORRECT ! VEUILLEZ RESSAYER !";
        }
        
    }

    // Transaction
    if (isset($_POST['trans'])) {
        $Selected_cpt1 = $_POST['select1'];
        $Checkclt = $database->prepare("SELECT * FROM compte WHERE IDCLT = ?  ORDER BY IDTY_CPTE");
        $Checkclt->execute(array($IdC));
        $tab_cpte = array();
        while ($Chec = $Checkclt->fetch()) {
            $tab_cpte[] = $Chec['TYPE'];
        }  
        if ($Selected_cpt1 == "Epargne") {
            ?>
                <label for="Cpt_arrv">Compte destinataire : </label>
                <select name="Cpt_arrv" id="Cpt_arrv">
                    <option value="">Selectionnez le compte</option>
                    <option value="<?=$tab_cpte[1]?>"><?=$tab_cpte[1]?></option>';             
                    <option value="<?=$tab_cpte[2]?>"><?=$tab_cpte[2]?></option>';             
                </select>
            <?php        
        }
        else if ($Selected_cpt1 == "Tontine") {
            ?>
                <label for="Cpt_arrv">Compte destinataire : </label>
                <select name="Cpt_arrv" id="Cpt_arrv">
                    <option value="">Selectionnez le compte</option>
                    <option value="<?=$tab_cpte[0]?>"><?=$tab_cpte[0]?></option>';             
                    <option value="<?=$tab_cpte[2]?>"><?=$tab_cpte[2]?></option>';             
                </select>
            <?php   
        }
        else if ($Selected_cpt1 == "Annuel") {
            ?>
                <label for="Cpt_arrv">Compte destinataire : </label>
                <select name="Cpt_arrv" id="Cpt_arrv">
                    <option value="">Selectionnez le compte</option>
                    <option value="<?=$tab_cpte[0]?>"><?=$tab_cpte[0]?></option>';             
                    <option value="<?=$tab_cpte[1]?>"><?=$tab_cpte[1]?></option>';             
                </select>
            <?php   
        }
        else {
            ?>
                <label for="Cpt_arrv">Compte destinataire : </label>
                <select name="Cpt_arrv" id="Cpt_arrv">
                    <option value="">Selectionnez le compte</option>
                </select>
            <?php 
        }    
    }

    // Tout ce passe ici, on recupere les compte plus haut
    // Et la transaction debute

    if (isset($_POST['trans_en_cours'])) {
        if (isset($_POST['bouton'])) {
            if ($_POST['select1'] == "" && $_POST['select2'] == "") {
                echo "SELECTIONNEZ LES COMPTES !";
            }
            else if ($_POST['select1'] == "") {
                echo "SELECTIONNEZ D'ABORD LE COMPTE DESTINATEUR !";
            }
            else if ($_POST['select2'] == "") {
                echo "SELECTIONNEZ LE COMPTE DESTINATAIRE !";
            }
            else if ($_POST['montant'] == "") {
                echo "ENTREZ LE MONTANT DE LA TRANSACTION POUR CONTINUER !";
            }
            else if ($_POST['pass'] == "") {
                echo "ENTREZ VOTRE MOT DE PASSE !";
            }
            else {
                if (password_verify($_POST['pass'],$data['PASS'])) {
                    if ($_POST['select1'] == "Epargne") {
                        if ($_POST['select2'] == "Tontine") {
                            $Ancien_sd_Ep = $sldep['SOLDE'];
                            $Ancien_sd_Tn = $sldtn['SOLDE'];

                            if ($Ancien_sd_Ep >= $_POST['montant']) {
                                $Nw_sd_Ep = $Ancien_sd_Ep - $_POST['montant'];
                                if ($Nw_sd_Ep >= 1001) {
                                    $Nw_sd_Tn = $Ancien_sd_Tn + $_POST['montant'];

                                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $retrait->execute(array($Nw_sd_Ep, $ty[0], $IdC));
                                    $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $depot->execute(array($Nw_sd_Tn, $ty[1], $IdC));

                                    $Id_trans_first = time() * 2;
                                    $ID_trans = substr($Id_trans_first,0,10);
                                    $trans = $database->prepare("INSERT INTO transaction (ID_TRANS,IDCLT,COMPTE_DPRT,LIBELLE_CPT_D,CPTE_ARRV,LIBELLE_CPT_A,MONTANT,DATE_TRANS) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                    $trans->execute(array($ID_trans,$IdC,$ID_CPTE_EP,$_POST['select1'],$ID_CPTE_TN,$_POST['select2'], $_POST['montant'],$Date));
                                    if ($retrait && $depot && $trans) {
                                        echo "TRANSACTION EFFECTUEE AVEC SUCCES DU COMPTE EPARGNE POUR LE COMPTE TONTINE POUR UN MONTANT DE ".$_POST['montant']. "FCFA\n";
                                        echo "ID TRANSACTION : ".$ID_trans;
                                    
                                    }
                                }
                                else {
                                    echo "TRANSACTION ECHOUEE, CAR LE COMPTE EPARGNE NE PEUT ETRE INFERIEUR A 1000 FCFA !";
                                }
                            }
                            else {
                                echo "LE SOLDE DU COMPTE EPARGNE (DESTINATEUR) EST INSUFFISSANT POUR CONTINUER LA TRANSACTION !";
                            }
                        }
                        else if ($_POST['select2'] == "Annuel") {
                            $Ancien_sd_Ep = $sldep['SOLDE'];
                            $Ancien_sd_An = $sldan['SOLDE'];

                            if ($Ancien_sd_Ep >= $_POST['montant']) {
                                $Nw_sd_Ep = $Ancien_sd_Ep - $_POST['montant'];
                                if ($Nw_sd_Ep >= 1001) {
                                    $Nw_sd_An = $Ancien_sd_An + $_POST['montant'];

                                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $retrait->execute(array($Nw_sd_Ep, $ty[0], $IdC));
                                    $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $depot->execute(array($Nw_sd_An, $ty[2], $IdC));

                                    $Id_trans_first = time() * 2;
                                    $ID_trans = substr($Id_trans_first,0,10);

                                    $trans = $database->prepare("INSERT INTO transaction (ID_TRANS,IDCLT,COMPTE_DPRT,LIBELLE_CPT_D,CPTE_ARRV,LIBELLE_CPT_A,MONTANT,DATE_TRANS) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                    $trans->execute(array($ID_trans,$IdC,$ID_CPTE_EP,$_POST['select1'],$ID_CPTE_AN,$_POST['select2'], $_POST['montant'],$Date));
                                    if ($retrait && $depot && $trans) {
                                        echo "TRANSACTION EFFECTUEE AVEC SUCCES DU COMPTE EPARGNE POUR LE COMPTE TONTINE POUR UN MONTANT DE ".$_POST['montant']. "FCFA\n";
                                        echo "ID TRANSACTION : ".$ID_trans;
                                    
                                    }
                                }
                                else {
                                    echo "TRANSACTION ECHOUEE, CAR LE COMPTE EPARGNE NE PEUT ETRE INFERIEUR A 1000 FCFA !";
                                }
                            }
                            else {
                                echo "LE SOLDE DU COMPTE EPARGNE (DESTINATEUR) EST INSUFFISSANT POUR CONTINUER LA TRANSACTION !";
                            }
                        }
                    }
                    else if ($_POST['select1'] == "Tontine") {
                        if ($_POST['select2'] == "Epargne") {
                            $Ancien_sd_Tn = $sldtn['SOLDE'];
                            $Ancien_sd_Ep = $sldep['SOLDE'];

                            if ($Ancien_sd_Tn >= $_POST['montant']) {
                                $Nw_sd_Tn = $Ancien_sd_Tn - $_POST['montant'];
                                if ($Nw_sd_Tn >= 1001) {
                                    $Nw_sd_Ep = $Ancien_sd_Ep + $_POST['montant'];

                                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $retrait->execute(array($Nw_sd_Tn, $ty[1], $IdC));
                                    $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $depot->execute(array($Nw_sd_Ep, $ty[0], $IdC));

                                    $Id_trans_first = time() * 2;
                                    $ID_trans = substr($Id_trans_first,0,10);

                                    $trans = $database->prepare("INSERT INTO transaction (ID_TRANS,IDCLT,COMPTE_DPRT,LIBELLE_CPT_D,CPTE_ARRV,LIBELLE_CPT_A,MONTANT,DATE_TRANS) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                    $trans->execute(array($ID_trans,$IdC,$ID_CPTE_TN,$_POST['select1'],$ID_CPTE_AN,$_POST['select2'], $_POST['montant'],$Date));
                                    if ($retrait && $depot && $trans) {
                                        echo "TRANSACTION EFFECTUEE AVEC SUCCES DU COMPTE TONTINE POUR LE COMPTE EPARGNE POUR UN MONTANT DE ".$_POST['montant']. "FCFA\n";
                                        echo "ID TRANSACTION : ".$ID_trans;
                                    
                                    }
                                }
                                else {
                                    echo "TRANSACTION ECHOUEE, CAR LE COMPTE TONTINE NE PEUT ETRE INFERIEUR A 1000 FCFA !";
                                }
                            }
                            else {
                                echo "LE SOLDE DU COMPTE TONTINE (DESTINATEUR) EST INSUFFISSANT POUR CONTINUER LA TRANSACTION !";
                            }
                        }
                        else if ($_POST['select2'] == "Annuel") {
                            $Ancien_sd_Tn = $sldtn['SOLDE'];
                            $Ancien_sd_An = $sldan['SOLDE'];

                            if ($Ancien_sd_Tn >= $_POST['montant']) {
                                $Nw_sd_Tn = $Ancien_sd_Tn - $_POST['montant'];
                                if ($Nw_sd_Tn >= 1001) {
                                    $Nw_sd_An = $Ancien_sd_An + $_POST['montant'];

                                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $retrait->execute(array($Nw_sd_Tn, $ty[1], $IdC));
                                    $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $depot->execute(array($Nw_sd_An, $ty[2], $IdC));

                                    $Id_trans_first = time() * 2;
                                    $ID_trans = substr($Id_trans_first,0,10);

                                    $trans = $database->prepare("INSERT INTO transaction (ID_TRANS,IDCLT,COMPTE_DPRT,LIBELLE_CPT_D,CPTE_ARRV,LIBELLE_CPT_A,MONTANT,DATE_TRANS) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                    $trans->execute(array($ID_trans,$IdC,$ID_CPTE_TN,$_POST['select1'],$ID_CPTE_AN,$_POST['select2'], $_POST['montant'],$Date));
                                    if ($retrait && $depot && $trans) {
                                        echo "TRANSACTION EFFECTUEE AVEC SUCCES DU COMPTE TONTINE POUR LE COMPTE ANNUEL POUR UN MONTANT DE ".$_POST['montant']. "FCFA\n";
                                        echo "ID TRANSACTION : ".$ID_trans;
                                    
                                    }
                                }
                                else {
                                    echo "TRANSACTION ECHOUEE, CAR LE COMPTE TONTINE NE PEUT ETRE INFERIEUR A 1000 FCFA !";
                                }
                            }
                            else {
                                echo "LE SOLDE DU COMPTE TONTINE (DESTINATEUR) EST INSUFFISSANT POUR CONTINUER LA TRANSACTION !";
                            }
                        }
                    }
                    else if ($_POST['select1'] == "Annuel") {
                        if ($_POST['select2'] == "Epargne") {
                            $Ancien_sd_An = $sldan['SOLDE'];
                            $Ancien_sd_Ep = $sldep['SOLDE'];

                            if ($Ancien_sd_An >= $_POST['montant']) {
                                $Nw_sd_An = $Ancien_sd_An - $_POST['montant'];
                                if ($Nw_sd_An >= 1001) {
                                    $Nw_sd_Ep = $Ancien_sd_Ep + $_POST['montant'];

                                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $retrait->execute(array($Nw_sd_An, $ty[2], $IdC));
                                    $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $depot->execute(array($Nw_sd_Ep, $ty[0], $IdC));

                                    $Id_trans_first = time() * 2;
                                    $ID_trans = substr($Id_trans_first,0,10);

                                    $trans = $database->prepare("INSERT INTO transaction (ID_TRANS,IDCLT,COMPTE_DPRT,LIBELLE_CPT_D,CPTE_ARRV,LIBELLE_CPT_A,MONTANT,DATE_TRANS) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                    $trans->execute(array($ID_trans,$IdC,$ID_CPTE_AN,$_POST['select1'],$ID_CPTE_EP,$_POST['select2'], $_POST['montant'],$Date));
                                    if ($retrait && $depot && $trans) {
                                        echo "TRANSACTION EFFECTUEE AVEC SUCCES DU COMPTE ANNUEL POUR LE COMPTE EPARGNE POUR UN MONTANT DE ".$_POST['montant']. "FCFA\n";
                                        echo "ID TRANSACTION : ".$ID_trans;
                                    
                                    }
                                }
                                else {
                                    echo "TRANSACTION ECHOUEE, CAR LE COMPTE ANNUEL NE PEUT ETRE INFERIEUR A 1000 FCFA !";
                                }
                            }
                            else {
                                echo "LE SOLDE DU COMPTE ANNUEL (DESTINATEUR) EST INSUFFISSANT POUR CONTINUER LA TRANSACTION !";
                            }
                        }
                        else if ($_POST['select2'] == "Tontine") {
                            $Ancien_sd_An = $sldan['SOLDE'];
                            $Ancien_sd_Tn = $sldtn['SOLDE'];

                            if ($Ancien_sd_An >= $_POST['montant']) {
                                $Nw_sd_An = $Ancien_sd_An - $_POST['montant'];
                                if ($Nw_sd_An >= 1001) {
                                    $Nw_sd_Tn = $Ancien_sd_Tn + $_POST['montant'];

                                    $retrait = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $retrait->execute(array($Nw_sd_An, $ty[2], $IdC));
                                    $depot = $database->prepare("UPDATE compte SET SOLDE = ? WHERE TYPE = ? AND IDCLT = ?");
                                    $depot->execute(array($Nw_sd_Tn, $ty[1], $IdC));

                                    $Id_trans_first = time() * 2;
                                    $ID_trans = substr($Id_trans_first,0,10);

                                    $trans = $database->prepare("INSERT INTO transaction (ID_TRANS,IDCLT,COMPTE_DPRT,LIBELLE_CPT_D,CPTE_ARRV,LIBELLE_CPT_A,MONTANT,DATE_TRANS) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                    $trans->execute(array($ID_trans,$IdC,$ID_CPTE_AN,$_POST['select1'],$ID_CPTE_TN,$_POST['select2'], $_POST['montant'],$Date));
                                    if ($retrait && $depot && $trans) {
                                        echo "TRANSACTION EFFECTUEE AVEC SUCCES DU COMPTE ANNUEL POUR LE COMPTE TONTINE POUR UN MONTANT DE ".$_POST['montant']. "FCFA\n";
                                        echo "ID TRANSACTION : ".$ID_trans;
                                    }
                                }
                                else {
                                    echo "TRANSACTION ECHOUEE, CAR LE COMPTE ANNUEL NE PEUT ETRE INFERIEUR A 1000 FCFA !";
                                }
                            }
                            else {
                                echo "LE SOLDE DU COMPTE ANNUEL (DESTINATEUR) EST INSUFFISSANT POUR CONTINUER LA TRANSACTION !";
                            }
                        }
                    }
                }
                else {
                    echo "MOT DE PASSE INCORRECT ! REESSAYEZ DE NOUVEAU !";
                }
            }
        }
    }

    if (isset($_POST['list_trans'])) {
        $fil = $_POST['fil_order'];

        if (isset($_POST['order'])) {
            $order = $_POST['order'];
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction WHERE IDCLT = '$IdC' ORDER BY ID_TRANS ASC";
                } else {
                    $query = "SELECT * FROM transaction WHERE IDCLT = '$IdC' ORDER BY $fil ASC";
                }
            } else {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction WHERE IDCLT = '$IdC' ORDER BY ID_TRANS DESC";
                } else {
                    $query = "SELECT * FROM transaction WHERE IDCLT = '$IdC' ORDER BY $fil DESC";
                }
            }
        }

        if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction WHERE ID_TRANS LIKE '%" . $_POST['search_text'] . "%' ORDER BY ID_TRANS ASC";
                }
                else {
                    $query = "SELECT * FROM transaction WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil'ASC";
                }
            } else {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction WHERE ID_TRANS LIKE '%" . $_POST['search_text'] . "%' ORDER BY ID_TRANS DESC";
                }
                else {
                    $query = "SELECT * FROM transaction WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil DESC";
                }      
            }
        }

        $state = $database->query($query);
        // $state->execute($IdC);
        $TotalClt = $state->rowCount();
        if ($TotalClt > 0) {
            while ($Dataclt = $state->fetch()) {
            ?>
                <tr id="Return">
                    <td><?php echo $Dataclt['ID_TRANS']; ?></td>
                    <td><?php echo $Dataclt['LIBELLE_CPT_D']; ?></td>
                    <td><?php echo $Dataclt['LIBELLE_CPT_A']; ?></td>
                    <td><?php echo $Dataclt['MONTANT']; ?></td>
                    <td><?php echo $Dataclt['DATE_TRANS']; ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
                <h4 class="Not__found"> Aucune transaction trouvée !</h4>
            <?php
        }
    }

    // liste transaction pour l'argent
    if (isset($_POST['list_trans_ad'])) {
        $fil = $_POST['fil_order'];

        if (isset($_POST['order'])) {
            $order = $_POST['order'];
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction ORDER BY ID_TRANS ASC";
                } else {
                    $query = "SELECT * FROM transaction ORDER BY $fil ASC";
                }
            } 
            else {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction ORDER BY ID_TRANS DESC";
                } else {
                    $query = "SELECT * FROM transaction ORDER BY $fil DESC";
                }
            }
        }

        if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction WHERE ID_TRANS LIKE '%" . $_POST['search_text'] . "%' ORDER BY ID_TRANS ASC";
                }
                else {
                    $query = "SELECT * FROM transaction WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil ASC";
                }
            } else {
                if ($_POST['fil_order'] == "ID_TRANS") {
                    $query = "SELECT * FROM transaction WHERE ID_TRANS LIKE '%" . $_POST['search_text'] . "%' ORDER BY ID_TRANS DESC";
                }
                else {
                    $query = "SELECT * FROM transaction WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil DESC";
                }      
            }
        }

        $state = $database->query($query);
        // $state->execute($IdC);
        $TotalClt = $state->rowCount();
        if ($TotalClt > 0) {
            while ($Dataclt = $state->fetch()) {
            ?>
                <tr id="Return">
                    <td><?php echo $Dataclt['ID_TRANS']; ?></td>
                    <td><?php echo $Dataclt['IDCLT']; ?></td>
                    <td><?php echo $Dataclt['LIBELLE_CPT_D']; ?></td>
                    <td><?php echo $Dataclt['LIBELLE_CPT_A']; ?></td>
                    <td><?php echo $Dataclt['MONTANT']; ?></td>
                    <td><?php echo $Dataclt['DATE_TRANS']; ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <h4 class="Not__found"> Aucune transaction trouvée !</h4>
            <?php
        }
    }

    // operation admin
    if (isset($_POST['list_oper_ad'])) {
        $fil = $_POST['fil_order'];

        if (isset($_POST['order'])) {
            $order = $_POST['order'];
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation ORDER BY IDOP ASC";
                } else {
                    $query = "SELECT * FROM operation ORDER BY $fil ASC";
                }
            } 
            else {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation ORDER BY IDOP DESC";
                } else {
                    $query = "SELECT * FROM operation ORDER BY $fil DESC";
                }
            }
        }

        if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation WHERE IDOP LIKE '%" . $_POST['search_text'] . "%' ORDER BY IDOP ASC";
                }
                else {
                    $query = "SELECT * FROM operation WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil ASC";
                }
            } else {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation WHERE IDOP LIKE '%" . $_POST['search_text'] . "%' ORDER BY IDOP DESC";
                }
                else {
                    $query = "SELECT * FROM operation WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil DESC";
                }      
            }
        }

        $state = $database->query($query);
        // $state->execute($IdC);
        $TotalClt = $state->rowCount();
        if ($TotalClt > 0) {
            while ($Dataclt = $state->fetch()) {
            ?>
                <tr id="Return">
                    <td><?php echo $Dataclt['IDOP']; ?></td>
                    <td><?php echo $Dataclt['IDCLT']; ?></td>
                    <td><?php echo $Dataclt['IDCPTE']; ?></td>
                    <td><?php echo $Dataclt['LIBELLEOP']; ?></td>
                    <td><?php echo $Dataclt['MONTANTOP']; ?></td>
                    <td><?php echo $Dataclt['DATEOP']; ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <h4 class="Not__found"> Aucune opération trouvée !</h4>
            <?php
        }
    }
    // operation client
    if (isset($_POST['list_oper_cl'])) {
        $fil = $_POST['fil_order'];

        if (isset($_POST['order'])) {
            $order = $_POST['order'];
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation WHERE IDCLT = '$IdC' ORDER BY IDOP ASC";
                } else {
                    $query = "SELECT * FROM operation WHERE IDCLT = '$IdC' ORDER BY $fil ASC";
                }
            } 
            else {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation WHERE IDCLT = '$IdC' ORDER BY IDOP DESC";
                } else {
                    $query = "SELECT * FROM operation WHERE IDCLT = '$IdC' ORDER BY $fil DESC";
                }
            }
        }

        if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation  WHERE IDCLT = '$IdC' AND IDOP LIKE '%" . $_POST['search_text'] . "%' ORDER BY IDOP ASC";
                }
                else {
                    $query = "SELECT * FROM operation  WHERE IDCLT = '$IdC' AND $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil ASC";
                }
            } else {
                if ($_POST['fil_order'] == "IDOP") {
                    $query = "SELECT * FROM operation  WHERE IDCLT = '$IdC' AND IDOP LIKE '%" . $_POST['search_text'] . "%' ORDER BY IDOP DESC";
                }
                else {
                    $query = "SELECT * FROM operation  WHERE IDCLT = '$IdC' AND $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil DESC";
                }      
            }
        }

        $state = $database->query($query);
        // $state->execute($IdC);
        $TotalClt = $state->rowCount();
        if ($TotalClt > 0) {
            while ($Dataclt = $state->fetch()) {
            ?>
                <tr id="Return">
                    <td><?php echo $Dataclt['IDOP']; ?></td>
                    <td><?php echo $Dataclt['IDCPTE']; ?></td>
                    <td><?php echo $Dataclt['LIBELLEOP']; ?></td>
                    <td><?php echo $Dataclt['MONTANTOP']; ?></td>
                    <td><?php echo $Dataclt['DATEOP']; ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <h4 class="Not__found"> Aucune opération trouvée !</h4>
            <?php
        }
    }

    // Demande de pret
    if (isset($_POST['dmd_pret'])) {
        $fil = $_POST['fil_order'];

        if (isset($_POST['order'])) {
            $order = $_POST['order'];
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "IDCLT") {
                    $query = "SELECT * FROM pret ORDER BY IDCLT ASC";
                } else {
                    $query = "SELECT * FROM pret ORDER BY $fil ASC";
                }
            } 
            else {
                if ($_POST['fil_order'] == "IDCLT") {
                    $query = "SELECT * FROM pret ORDER BY IDCLT DESC";
                } else {
                    $query = "SELECT * FROM pret ORDER BY $fil DESC";
                }
            }
        }

        if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
            if ($order == 'ASC') {
                if ($_POST['fil_order'] == "IDCLT") {
                    $query = "SELECT * FROM pret WHERE IDCLT LIKE '%" . $_POST['search_text'] . "%' ORDER BY IDCLT ASC";
                }
                else {
                    $query = "SELECT * FROM pret WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil ASC";
                }
            } else {
                if ($_POST['fil_order'] == "IDCLT") {
                    $query = "SELECT * FROM pret WHERE IDCLT LIKE '%" . $_POST['search_text'] . "%' ORDER BY IDCLT DESC";
                }
                else {
                    $query = "SELECT * FROM pret WHERE $fil LIKE '%" . $_POST['search_text'] . "%' ORDER BY $fil DESC";
                }      
            }
        }

        $state = $database->query($query);
        // $state->execute($IdC);
        $TotalClt = $state->rowCount();
        if ($TotalClt > 0) {
            while ($Dataclt = $state->fetch()) {
            ?>
                <tr id="Return">
                    <td><?php echo $Dataclt['IDCLT']; ?></td>
                    <td><?php echo $Dataclt['MONTANTPRET']; ?></td>
                    <td><?php echo $Dataclt['MOTIF']; ?></td>
                    <td><?php echo $Dataclt['DATEPRET']; ?></td>
                    <td><?php echo $Dataclt['DATEREM']; ?></td>
                    <td><?php echo $Dataclt['LIBELLE']; ?></td>
                    <td><?php echo $Dataclt['DESCRIPTION']; ?></td>
                    <td><?php echo $Dataclt['ETAT']; ?></td>
                    <td class="action">
                        <a href="refus_pret.php?id=<?= $Dataclt['IDCLT'] ?>" class="Btn_delete"><i class="fa-solid fa-close"></i></a>
                        <a href="traitement_pret.php?id=<?= $Dataclt['IDCLT'] ?>" class="Btn_show"><i class="fa-solid fa-check"></i></a>
                    </td>
                </tr>

                <style>
                    .action {
                        display: flex;
                        justify-content: center;
                        gap: 20px;
                    }
                    .action a {
                        font-size: 16px;
                    }
                </style>
            <?php
            }
        } else {
            ?>
            <h4 class="Not__found"> Aucune opération trouvée !</h4>
            <?php
        }
    }
}

?>