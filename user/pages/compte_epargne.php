<?php
    session_start();
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../../index.php');
    }else {
        $IdC = $_SESSION['ID'];

        include "../../config/bd_cnx.php";
        // echo($NomUser);
        $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $sql->execute(array($IdC));
        $data = $sql->fetch();
        $NomUser = $data['NOM'];
        $Avatar = $data['PROFIL'];

        $req = $database->prepare("SELECT * FROM compte WHERE IDCLT = ? AND TYPE = 'Epargne'");
        $req->execute(array($IdC));
        $data = $req->fetch();
    }
   
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Détails compte Epargne";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../../style/compte_epargne.css">
    <link rel="stylesheet" href="../../style/contact.css">
    <link rel="stylesheet" href="../../style/box.css">
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

            <div class="Form__container content__padding">
                <div class="Form">
                    <div class="Form__header">
                        <div class="Title">
                            <h3>Détails Compte Epargne</h3>
                        </div>
                    </div>

                    <form class="Add__scrollY" action="" method="POST">
                        <div class="cpte">
                            <div class="cpte_img">
                                <i class="fa-solid fa-leaf"></i>
                                <span>Compte Epargne</span>
                            </div>
                            <div class="cpte_infos">
                                <span>Date de creation : <?=$data['DATECREATE']?></span>
                                <span>Id du compte : <?=$data['IDCPTE']?></span>
                                <span>Solde : <?=$data['SOLDE']?> fcfa</span>
                            </div>
                        </div>
                        <div class="cpte_activity">
                            <div class="Contact">
                                <div class="Contact__control">
                                    <div class="Control__display">
                                        <label for="Input__search">Rechercher une date :</label>
                                        <input type="search" id="Input__search" name="Input__search" placeholder="rechercher">
                                    </div>
                                    <div class="Control__display Count__fetch"> 
                                        <!-- <span> <?php echo strval($TotalEmp) ?> employé(s)</span> -->
                                    </div>
                                </div>
                                <div class="RecentOrders">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>Date Opération</td>
                                                <td>Opération</td>
                                                <td>Montant</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="Login__button">
                        <a href="compte_tontine.php">
                            <i class="fa-solid fa-line-chart"></i>
                            <span>Compte Tontine</span>
                        </a>
                        <a href="compte_annuel.php">
                            <i class="fa-solid fa-line-chart"></i>
                            <span>Compte Annuel</span>
                        </a>
                    </div>
                </div>
            </div>

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
            let action = "";
            let search_txt = $("#Input__search").val();
            $.ajax ({
                type: 'POST',
                url: '../../config/ajax_type_cpt.php',
                data: {search: 'search',action:action,search_txt:search_txt},
                success:  (Response) => {
                    // alert(Response);
                    $("tbody").html(Response);                    
                }
            })
            $('#Input__search').keyup(() => {
                let search = $(this).text();               
                Return_data();
            })
        })
    </script>
</body>

</html>