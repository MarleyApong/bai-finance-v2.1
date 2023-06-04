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
    }
   
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Effectuer une transaction";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../../style/go_transaction.css">
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
                            <h3>Effectuer une transaction</h3>
                        </div>
                    </div>

                    <form class="Add__scrollY" action="" method="POST">
                        <div class="Info_Even">

                            <div class="Info_Even__header">
                                <div class="Important">
                                    <span></span>
                                    <h4> NB : Les champs obligatoires apparaissent en <span class="red">rouge</span>.
                                    </h4>
                                </div>
                            </div>

                            <div class="Info_Even__content">
                                <div class="Name__group">
                                    <h3>Remplissez le formulaire</h3>
                                </div>

                                <div class="All_info_Even">
                                    <div class="Input__box">
                                        <label for="Cpt_dprt">Compte destinateur : </label>
                                        <select name="Cpt_dprt" id="Cpt_dprt">
                                        <option value="">Selectionnez le compte</option>
                                            <?php
                                                $Checkclt = $database->prepare("SELECT * FROM compte WHERE IDCLT = ?  ORDER BY IDTY_CPTE");
                                                $Checkclt->execute(array($IdC));
                                                while ($Chec = $Checkclt->fetch()) {
                                                    echo '<option value="'.$Chec['TYPE'].'">'.$Chec['TYPE'].'</option>';
                                                }
                                            ?>
                                        </select>
                                        <small class="Error2">Entrez le compte destinateur</small>
                                    </div>

                                    <div class="Input__box receved">
                            
                                    </div>

                                    <div class="Input__box">
                                        <label for="NomPers_Even">Montant : </label>
                                        <input type="number" id="Mnt_tra" name="Mnt_tra" autocomplete="off"/>
                                        <small class="Error2">Entrez le montant</small>
                                    </div>

                                    <div class="Input__box">
                                        <label for="Pass">Mot de passe : </label>
                                        <input type="password" id="Pass" name="Pass" />
                                        <small class="Error2">Entrez le mot de passe</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Login__button">
                            <button id="hj" name="submit">
                                <!-- <i class="fa-brands fa-telegra"></i> -->
                                <span>Valider</span>
                            </button>
                            <a href="liste_transaction.php">
                                <i class="fa-solid fa-line-chart"></i>
                                <span>Liste des transactions</span>
                            </a>
                        </div>
                </div>
                </form>
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
            let Select_cpt1 = $('#Cpt_dprt').children("option:selected").val();
            let Select_cpt2 = $('#Cpt_arrv').children("option:selected").val();
            let Mont = $('#Mnt_tra').val();
            let Pass_cpt = $('#Pass').val();
            
            Return_data();
            function Return_data() {
                let trans = '';              
                let select1 = $("#Cpt_dprt").val();    
                let select2 = $("#Cpt_arrv").val();             
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_access.php',
                    data: {select1:select1,select2:select2,trans:trans},
                    success:  (Response) => {
                        $(".receved").html(Response);                                       
                    }
                })

            }
            $("#Cpt_dprt").change(() => {
                let go = $(this).children("option:selected").val();
                Return_data();
            })

            $("#Cpt_arrv").change(() => {
                let come = $(this).children("option:selected").val();
                Return_data();
            })

            // Bouton pour effectuer la transaction

            $("#hj").click(() => {
                let Select_cpt1 = $('#Cpt_dprt').children("option:selected").val();
                let Select_cpt2 = $('#Cpt_arrv').children("option:selected").val();
                let Mont = $('#Mnt_tra').val();
                let Pass_cpt = $('#Pass').val();
                let Error = $('.Error');
                let Error2 = $('.Error2');
                
                Return_data2();
                function Return_data2() {
                    let trans_en_cours = "";
                    let bouton = $("#hj").val();               
                    let select1 = $("#Cpt_dprt").val();    
                    let select2 = $("#Cpt_arrv").val();    
                    let montant = $("#Mnt_tra").val();           
                    let pass = $("#Pass").val();           
                    $.ajax ({
                        type: 'POST',
                        url: '../../config/ajax_access.php',
                        data: {bouton: 'bouton',select1:select1,select2:select2,montant:montant,pass:pass,trans_en_cours:trans_en_cours},
                        success:  (Response) => {
                            alert(Response);
                            // $(".receved").html(Response);                                       
                        }
                    })
                }
            })
        })
        
    </script>
</body>

</html>