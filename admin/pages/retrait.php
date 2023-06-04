<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    $Title = 'Retrait';
    require_once '../include/head.php'
    ?>
    <link rel="stylesheet" href="../styles/retrait.css">
    <link rel="stylesheet" href="../../style/formHeader.css">
    <link rel="stylesheet" href="../../style/box.css">
</head>

<body>
    <div class="Top">
        <?php
        require_once '../include/navigation.php';
        ?>

        <div class="Main">
            <?php
            require_once '../include/topbar.php';
            ?>

            <div class="Form__container content__padding">
                <div class="Form">
                    <div class="Form__header">
                        <div class="Title">
                            <h3>Retrait</h3>
                        </div>
                    </div>

                    <form class="Add__scrollY" action="" method="POST">
                        <div class="Info_Even">

                            <div class="Info_Even__header">
                                <div class="Important">
                                    <span></span>
                                    <h4> NB : Les champs obligatoires apparaissent en <span class="Red">rouge</span>.
                                    </h4>
                                </div>
                            </div>
                            
                            <div class="Info_Even__content">
                                <div class="Name__group">
                                    <h3>Remplissez le formulaire</h3>
                                </div>
                                <div class="Resul"></div>
                                <div class="All_info_Even">
                                    <div class="Input__box">
                                        <label for="Id_c">Entrez l'id du client : </label>
                                        <input type="text" id="Id_c" name="Id_c" />
                                        <small class="Error2">Entrez l'id du client</small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Resul_s">Resultat de la recherche : </label>
                                        <input type="text" id="Resul_s" name="Resul_s" disabled />
                                        <!-- <small class="Error2">Entrez l'id du client</small> -->
                                    </div>
                                    <div class="Input__box" id="Type_c">

                                    </div>

                                    <div class="Input__box">
                                        <label for="Mont_cpt">Montant : </label>
                                        <input type="number" id="Mont_cpt" name="Mont_cpt" />
                                        <small class="Error2">Entrez le montant</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Login__button">
                            <button name="submit" id="hj">
                                <!-- <i class="fa-brands fa-telegram"></i> -->
                                <span>Envoyez confirmation</span>
                            </button>
                            <a href="../solde/solde.php">
                                <i class="fa-solid fa-line-chart"></i>
                                <span>Solde</span>
                            </a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootom_bar -->
    <?php
    require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        $('form').submit((e)=> {
            let Select_cpt = $('#Type_cpt').children("option:selected").val();
            let Input_case = $('#Mont_cpt').val();
            let Error = $('.Error');
            let Error2 = $('.Error2');
            if (Select_cpt == "") {
                e.preventDefault();
                Error.addClass('error');
            }
            else if (Input_case == "") {
                e.preventDefault();
                Error2.addClass('error');
            }
        })

        $("#hj").click((e) => {
            let Select_cpt = $('#Type_cpt').children("option:selected").val();
            let Input_case = $('#Mont_cpt').val();
            let Error = $('.Error');
            let Error2 = $('.Error2');
            if (Select_cpt == "") {
                e.preventDefault();
                Error.addClass('error');
            }
            if (Input_case == "") {
                e.preventDefault();
                Error2.addClass('error');
            }if (Input_case != "" && Select_cpt != "") {
                Return_data();
                function Return_data() {
                let retrait = '';
                let bouton = $("#hj").val();               
                let select = $("#Type_cpt").val();    
                let montant = $("#Mont_cpt").val();           
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_dr.php',
                    data: {bouton: 'bouton',retrait:retrait,select:select,montant:montant},
                    success:  (Response) => {
                        alert(Response);
                        // $("body").html(Response);                    
                        // $(".Count__fetch").html(Response);                    
                    }
                })
            }

            $("#Type_cpt").change(() => {
                let type = $(this).children("option:selected").val();
                Return_data();
            })
            
            $("#hj").click(() => {
                let bt = $(this).addClass("none");
                // console.log(bt);
                Return_data();
            })
            }
           
        })

        $('#Id_c').keyup(() => {
            let search = $(this).text();               
            let search_id = '';
            let search_text = $("#Id_c").val();                
            $.ajax ({
                type: 'POST',
                url: '../../config/ajax_dr.php',
                data: {search: 'search',search_id:search_id,search_text:search_text},
                success:  (Response) => {
                    // alert(Response);  
                    $('#Resul_s').val(Response);               
                }
            })

            let select = '';
            let ss = $("#Id_c").val()
            // let Type_cpt = $(this).val();
            $.ajax ({
                type: 'POST',
                url: '../../config/ajax_dr.php',
                data: {select:select,ss:ss},
                success:  (Response) => {
                    // alert(Response);  
                    $('#Type_c').html(Response);               
                }
            })
        })
        
    </script>
</body>

</html>