<?php
    session_start();
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../../index.php');
    }else {
        $IdC = $_SESSION['ID'];

        include "../../config/bd_cnx.php";
        $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $sql->execute(array($IdC));
        $data = $sql->fetch();
        $NomUser = $data['NOM'];
        $Avatar = $data['PROFIL'];

        $Checkclt = $database->query("SELECT NOMTYPE FROM type_compte ORDER BY IDTY_CPTE");
        $Idty = array();
        $Nomtty = array();

        while ($Check = $Checkclt->fetch()) {
            $ty[] = $Check['NOMTYPE'];
        }
        $ep = $ty[0];
        $tn = $ty[1];
        $an = $ty[2];

            $Ch = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ?");
            $Ch2 = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ?");
            $Ch3 = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ?");
            $Ch->execute(array($ep, $IdC));
            $Ch2->execute(array($tn, $IdC));
            $Ch3->execute(array($an, $IdC));
            $Solde_epargne = $Ch->fetch();
            $Solde_tontine = $Ch2->fetch();
            $Solde_annuel = $Ch3->fetch();
    }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Tableau de bord";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/contact.css">
    <link rel="stylesheet" href="../../style/Tableau_de_bord.css">

</head>

<body>
    <div class="Top">
        <!-- nav -->
        <?php
            require_once '../include/navigation.php';
        ?>
        <div class="Main">
            <!-- top_bar -->
            <?php
                require_once '../include/topbar.php';
            ?>
            
            <div class="Form__header">
                <div class="Title">
                    <h3>Tableau de bord</h3>
                </div>
            </div>
            <div class="Widget1">
                <div class="Card">
                    <i class="fa-solid fa-leaf"></i>
                    <span>
                        <small>Compte Epargne :</small>
                        <small><?=$Solde_epargne['SOLDE']?> fcfa</small>
                    </span>
                </div>
                <div class="Card">
                    <i class="fa-solid fa-handshake"></i>
                    <span>
                        <small>Compte Tontine :</small>
                        <small><?=$Solde_tontine['SOLDE']?> fcfa</small>
                    </span>
                </div>
                <div class="Card">
                    <i class="fa-solid fa-hourglass-2"></i>
                    <span>
                        <small>Compte Annuel : </small>
                        <small><?=$Solde_annuel['SOLDE']?> fcfa</small>
                    </span>
                </div>
                <div class="Card">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                    <span>
                        <small>Total transaction : </small>
                        <small>
                            <?php
                                $req = $database->query("SELECT ID_TRANS FROM transaction WHERE IDCLT = '$IdC'");
                                $tt = $req->rowCount();
                                echo $tt;
                            ?>
                        </small>
                    </span>
                </div>
            </div>

            <div class="Form__header">
                <div class="Title">
                    <h3>Liste des transactions</h3>
                </div>
            </div>

            <form method="POST" class="Contact">
                <div class="Contact__control">
                    <div class="Control__display">
                        <label for="Order">Trier par :</label>
                        <select name="Order" id="Order">
                            <option value="ASC">ordre croissant</option>
                            <option value="DESC">ordre décroissant</option>
                        </select>
                    </div>
                    <div class="Control__display">
                        <label for="Filter">Filtrer par :</label>
                        <select name="Filter" id="Filter">
                            <option value="ID_TRANS">Id transaction</option>
                            <option value="MONTANT">Montant</option>
                            <option value="DATE_TRANS">Date transaction</option>
                        </select>
                    </div>
                    <div class="Control__display">
                        <label for="Input__search">Rechercher</label>
                        <input type="text" id="Input__search" name="Input__search" placeholder="rechercher">
                    </div>
                    <div class="Control__display Count__fetch"> 
                        <!-- <span> <?php echo strval($TotalEmp) ?> employé(s)</span> -->
                    </div>
                </div>

                <div class="RecentOrders">
                    <table>
                        <thead>
                            <tr>
                                <td>Id transaction</td>
                                <td>Compte départ</td>
                                <td>Compte Arrivé</td>
                                <td>Montant</td>
                                <td>Date transaction</td>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>
    <!-- bottom_bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(() => {
            Return_data();
            function Return_data() {
                let list_trans = '';
                let order = $("#Order").val();
                let fil_order = $("#Filter").val();
                let search_text = $("#Input__search").val();                
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_access.php',
                    data: {search: 'search',list_trans:list_trans,search_text:search_text,order:order,fil_order:fil_order},
                    success:  (Response) => {
                        $("tbody").html(Response);                    
                        // $(".Count__fetch").html(Response);                    
                    }
                })
            }

            $("#Filter").change(() => {
                let filter = $(this).children("option:selected").val();
                Return_data();
            })
            
            $("#Order").change(() => {
                let order = $(this).children("option:selected").val();
                Return_data();
            })

            $('#Input__search').keyup(() => {
                let search = $(this).text();               
                Return_data();
            })
        })
    </script>
</body>

</html>