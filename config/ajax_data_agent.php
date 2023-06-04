<?php
// error_reporting(0);
include 'bd_cnx.php';

if (isset($_POST['action'])) {
    $fil = $_POST['fil_order'];
    if (isset($_POST['fil_order'])) {
        if ($_POST['fil_order'] == "NOM") {
            $query = "SELECT * FROM client ORDER BY NOM";
        } else {
            $query = "SELECT * FROM client ORDER BY '$fil'";
        }
    }

    if (isset($_POST['order'])) {
        $order = $_POST['order'];
        if ($order == 'ASC') {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client ORDER BY NOM ASC";
            } else {
                $query = "SELECT * FROM client ORDER BY '$fil' ASC";
            }
        } else {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client ORDER BY NOM DESC";
            } else {
                $query = "SELECT * FROM client ORDER BY '$fil' DESC";
            }
        }
    }

    // $query = "SELECT * FROM `employe`";
    if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
        if ($order == 'ASC') {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client WHERE NOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY NOM ASC";
            }
            else if ($_POST['fil_order'] == "PRENOM") {
                $query = "SELECT * FROM client WHERE PRENOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY PRENOM ASC";
            }
            else {
                $query = "SELECT * FROM client WHERE DATECREAT LIKE '%" . $_POST['search_text'] . "%' ORDER BY DATECREAT ASC";
            }
        } else {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client WHERE NOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY NOM DESC";
            }
            else if ($_POST['fil_order'] == "PRENOM") {
                $query = "SELECT * FROM client WHERE PRENOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY PRENOM DESC";
            }
            else {
                $query = "SELECT * FROM client WHERE DATECREAT LIKE '%" . $_POST['search_text'] . "%' ORDER BY DATECREAT DESC";
            }      
        }
    }

    $state = $database->prepare($query);
    $state->execute();
    $TotalClt = $state->rowCount();
    if ($TotalClt > 0) {
        while ($Dataclt = $state->fetch()) {
            $Nais = strval(substr($Dataclt['DATENAIS'],0,4));
            $Age = date('Y') - $Nais;
        ?>
            <tr id="Return">
                <?php
                    if ($Dataclt['PROFIL'] == null) {
                        ?>
                            <td class="Set_profil"><img src="../../img/profil/placeholder.png"/></td>
                        <?php    
                    }
                    else {
                        ?>
                            <td class="Set_profil"><img src="data:image;base64,<?=base64_encode($Dataclt['PROFIL'])?>"/></td>
                        <?php    
                    }
                ?>
                <td><?php echo $Dataclt['IDCLT']; ?></td>
                <td><?php echo $Dataclt['NOM']; ?></td>
                <td><?php echo $Dataclt['PRENOM']; ?></td>
                <td><?php echo $Age; ?></td>
                <td><?php echo $Dataclt['SEXE']; ?></td>
                <td><?php echo $Dataclt['QUARTIER']; ?></td>
                <td><?php echo $Dataclt['TEL']; ?></td>
                <td><a href="edit_client.php?id=<?= $Dataclt['IDCLT'] ?>" class="Btn_show"><i class="fa-solid fa-eye"></i></a></td>
                <!-- <td><a onclick="return confirm('Supprimer le client, supprimera également son compte. Etes-vous sûr de votre décision ?')" href="supprim_client.php?id=<?= $Dataclt['IDCLT'] ?>" class="Btn_delete"><i class="fa-solid fa-trash"></i></a></td> -->
            </tr>
        <?php
        }
    } else {
        ?>
        <h4 class="Not__found"> Aucun client trouvé !</h4>
        <?php
    }
}

// liste client admin

if (isset($_POST['actionAd'])) {
    $fil = $_POST['fil_order'];
    if (isset($_POST['fil_order'])) {
        if ($_POST['fil_order'] == "NOM") {
            $query = "SELECT * FROM client ORDER BY NOM";
        } else {
            $query = "SELECT * FROM client ORDER BY '$fil'";
        }
    }

    if (isset($_POST['order'])) {
        $order = $_POST['order'];
        if ($order == 'ASC') {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client ORDER BY NOM ASC";
            } else {
                $query = "SELECT * FROM client ORDER BY '$fil' ASC";
            }
        } else {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client ORDER BY NOM DESC";
            } else {
                $query = "SELECT * FROM client ORDER BY '$fil' DESC";
            }
        }
    }

    // $query = "SELECT * FROM `employe`";
    if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
        if ($order == 'ASC') {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client WHERE NOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY NOM ASC";
            }
            else if ($_POST['fil_order'] == "PRENOM") {
                $query = "SELECT * FROM client WHERE PRENOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY PRENOM ASC";
            }
            else {
                $query = "SELECT * FROM client WHERE DATECREAT LIKE '%" . $_POST['search_text'] . "%' ORDER BY DATECREAT ASC";
            }
        } else {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client WHERE NOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY NOM DESC";
            }
            else if ($_POST['fil_order'] == "PRENOM") {
                $query = "SELECT * FROM client WHERE PRENOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY PRENOM DESC";
            }
            else {
                $query = "SELECT * FROM client WHERE DATECREAT LIKE '%" . $_POST['search_text'] . "%' ORDER BY DATECREAT DESC";
            }      
        }
    }

    $state = $database->prepare($query);
    $state->execute();
    $TotalClt = $state->rowCount();
    if ($TotalClt > 0) {
        while ($Dataclt = $state->fetch()) {
            $Nais = strval(substr($Dataclt['DATENAIS'],0,4));
            $Age = date('Y') - $Nais;
        ?>
            <tr id="Return">
                <?php
                    if ($Dataclt['PROFIL'] == null) {
                        ?>
                            <td class="Set_profil"><img src="../../img/profil/placeholder.png"/></td>
                        <?php    
                    }
                    else {
                        ?>
                            <td class="Set_profil"><img src="data:image;base64,<?=base64_encode($Dataclt['PROFIL'])?>"/></td>
                        <?php    
                    }
                ?>
                <td><?php echo $Dataclt['IDCLT']; ?></td>
                <td><?php echo $Dataclt['NOM']; ?></td>
                <td><?php echo $Dataclt['PRENOM']; ?></td>
                <td><?php echo $Age; ?></td>
                <td><?php echo $Dataclt['SEXE']; ?></td>
                <td><?php echo $Dataclt['QUARTIER']; ?></td>
                <td><?php echo $Dataclt['TEL']; ?></td>
                <td><a href="edit_client.php?id=<?= $Dataclt['IDCLT'] ?>" class="Btn_show"><i class="fa-solid fa-eye"></i></a></td>
                <td><a onclick="return confirm('Supprimer le client, supprimera également son compte. Etes-vous sûr de votre décision ?')" href="supprim_client.php?id=<?= $Dataclt['IDCLT'] ?>" class="Btn_delete"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
        <?php
        }
    } else {
        ?>
            <h4 class="Not__found"> Aucun client trouvé !</h4>
        <?php
    }
}

// liste admin

if (isset($_POST['liste_admin'])) {
    $fil = $_POST['fil_order']; 
    if (isset($_POST['fil_order'])) {
        if ($_POST['fil_order'] != "Tous") {
            $query = "SELECT * FROM employe WHERE STATUT = '$fil'";
        } 
        else {
            $query = "SELECT * FROM employe";
        }

    }

    if (isset($_POST['order'])) {
        $order = $_POST['order'];
        if ($order == 'ASC') {
            if ($_POST['fil_order'] != "Tous") {
                $query = "SELECT * FROM employe WHERE STATUT = '$fil' ORDER BY NOMEMP ASC"; 
            } 
            else {
                $query = "SELECT * FROM employe ORDER BY NOMEMP ASC"; 
            }
        }
        else{
            if ($_POST['fil_order'] != "Tous") {
                $query = "SELECT * FROM employe WHERE STATUT = '$fil' ORDER BY NOMEMP DESC"; 
            } 
            else {
                $query = "SELECT * FROM employe ORDER BY NOMEMP DESC"; 
            }
        }
        
    }

    // $query = "SELECT * FROM `employe`";
    if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
        if ($order == 'ASC') {
            $query = "SELECT * FROM employe WHERE NOMEMP LIKE '%".$_POST['search_text']."%' ORDER BY NOMEMP ASC";
        }
        else {
            $query = "SELECT * FROM employe WHERE NOMEMP LIKE '%".$_POST['search_text']."%' ORDER BY NOMEMP DESC";
        }
    }
    
    $state = $database->prepare($query);
    $state->execute();
    $TotalEmp = $state->rowCount();
    if ($TotalEmp > 0) {
        while ($Dataemp = $state->fetch()) {
            $Nais = strval(substr($Dataemp['DATENAISEMP'],0,4));
            $Age = date('Y') - $Nais;
            ?>
            <tr id="Return">
            <?php
                    if ($Dataemp['PROFIL'] == null) {
                        ?>
                            <td class="Set_profil"><img src="../../img/profil/placeholder.png"/></td>
                        <?php    
                    }
                    else {
                        ?>
                            <td class="Set_profil"><img src="data:image;base64,<?=base64_encode($Dataemp['PROFIL'])?>"/></td>
                        <?php    
                    }
                ?>
                <td><?php echo $Dataemp['IDEMP']; ?></td>
                <td><?php echo $Dataemp['NOMEMP']; ?></td>
                <td><?php echo $Dataemp['PRENOMEMP']; ?></td>
                <td><?php echo $Age; ?></td>
                <td><?php echo $Dataemp['SEXEEMP']; ?></td>
                <td><?php echo $Dataemp['QUARTIER']; ?></td>
                <td><?php echo $Dataemp['TEL']; ?></td>
                <td><?php echo $Dataemp['ETATCPTE']; ?></td>
                <td><a href="edit_admin.php?id=<?=$Dataemp['IDEMP']?>" class="Btn_show"><i class="fa-solid fa-eye"></i></a></td>
            </tr>
            <?php
        }
    }
    else {
        ?>
            <h4 class="Not__found"> Aucun employé trouvé !</h4>
        <?php
    } 
}

// details compte cote admin
if (isset($_POST['details_cpt'])) {
    $fil = $_POST['fil_order'];
    if (isset($_POST['fil_order'])) {
        if ($_POST['fil_order'] == "NOM") {
            $query = "SELECT * FROM client ORDER BY NOM";
        } else {
            $query = "SELECT * FROM client ORDER BY '$fil'";
        }
    }

    if (isset($_POST['order'])) {
        $order = $_POST['order'];
        if ($order == 'ASC') {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client ORDER BY NOM ASC";
            } else {
                $query = "SELECT * FROM client ORDER BY '$fil' ASC";
            }
        } else {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client ORDER BY NOM DESC";
            } else {
                $query = "SELECT * FROM client ORDER BY '$fil' DESC";
            }
        }
    }

    // $query = "SELECT * FROM `employe`";
    if (isset($_POST['search_text']) && !empty($_POST['search_text'])) {
        if ($order == 'ASC') {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client WHERE NOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY NOM ASC";
            } else if ($_POST['fil_order'] == "PRENOM") {
                $query = "SELECT * FROM client WHERE PRENOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY PRENOM ASC";
            } else {
                $query = "SELECT * FROM client WHERE DATECREAT LIKE '%" . $_POST['search_text'] . "%' ORDER BY DATECREAT ASC";
            }
        } else {
            if ($_POST['fil_order'] == "NOM") {
                $query = "SELECT * FROM client WHERE NOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY NOM DESC";
            } else if ($_POST['fil_order'] == "PRENOM") {
                $query = "SELECT * FROM client WHERE PRENOM LIKE '%" . $_POST['search_text'] . "%' ORDER BY PRENOM DESC";
            } else {
                $query = "SELECT * FROM client WHERE DATECREAT LIKE '%" . $_POST['search_text'] . "%' ORDER BY DATECREAT DESC";
            }
        }
    }

    $Req1 = $database->prepare($query);
    $Req1->execute();
    $TotalClt = $Req1->rowCount();
    if ($TotalClt > 0) {
        // $Req1 = $database->query("SELECT * FROM `client`");
        $Checkclt = $database->query("SELECT NOMTYPE FROM type_compte ORDER BY IDTY_CPTE");
        // $query2 = $database->query('SELECT * FROM `type_compte` ');
        $Idty = array();
        $Nomtty = array();

        while ($Check = $Checkclt->fetch()) {
            $ty[] = $Check['NOMTYPE'];
            // $solde [] = $Check['SOLDE'];
        }
        $ep = $ty[0];
        $tn = $ty[1];
        $an = $ty[2];
        // print_r($solde);

        // while ($Dataclt = $Checkclt->fetch()) {
        while ($DataReq1 = $Req1->fetch()) {
            $Ch = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ? ORDER BY DATECREATE");
            $Ch2 = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ? ORDER BY DATECREATE");
            $Ch3 = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ? ORDER BY DATECREATE");
            $Ch->execute(array($ep, $DataReq1['IDCLT']));
            $Ch2->execute(array($tn, $DataReq1['IDCLT']));
            $Ch3->execute(array($an, $DataReq1['IDCLT']));
            $ok = $Ch->fetch();
            $ok2 = $Ch2->fetch();
            $ok3 = $Ch3->fetch();

            if ($Checkclt->rowCount() > 0) {
                $TmpDate = substr($DataReq1['DATENAIS'], 0, 4);
                $DateNow = date('Y');
                $Age = strval($DateNow) - strval($TmpDate)
                ?>
                    <tr id="Return">
                        <td><?php echo $DataReq1['IDCLT']; ?></td>
                        <td><?php echo $DataReq1['NOM']; ?></td>
                        <td><?php echo $DataReq1['PRENOM']; ?></td>
                        <td><?php echo $Age; ?></td>
                        <td><?php echo $ok['SOLDE']; ?></td>
                        <td><?php echo $ok2['SOLDE']; ?></td>
                        <td><?php echo $ok3['SOLDE']; ?></td>
                        <td><?php echo $DataReq1['DATECREAT']; ?></td>
                        <!-- <td><i class="fa-solid fa-external-link"></i></td> -->
                    </tr>
                <?php
            } else {
                ?>
                    <h4 class="Not__found"> Aucun client trouvé !</h4>
                <?php
            }
        }

    }
    else {
        ?>
            <h4 class="Not__found"> Aucun client trouvé !</h4>
        <?php
    }
}

?>