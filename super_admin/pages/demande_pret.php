<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Liste de pret";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../style/demande_pret.css">
    <link rel="stylesheet" href="../../admin/styles/splecial.css">
</head>

<body>
    <div class="Top">
        <!-- nav -->
        <?php
            require_once '../include/navigation.php';
        ?>
        <div class="Main">
            <!-- topbar -->
            <?php
                require_once '../include/topbar.php';
            ?>

        <div class="Form__header">
            <div class="Title">
                <h3>Liste de prêt(s)</h3>
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
                            <option value="IDCLT">id client</option>
                            <option value="MONTANTPRET">montant</option>
                            <option value="MOTIF">motif</option>
                            <option value="DATEPRET">date de pret</option>
                            <option value="DATEREM">date de remboursement</option>
                            <option value="LIBELLE">libelle</option>
                            <option value="ETAT">etat</option>
                        </select>
                    </div>
                    <div class="Control__display">
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
                                <td>Id client</td>
                                <td>Montant</td>
                                <td>Motif</td>
                                <td>Date de pret</td>
                                <td>Date remboursement</td>
                                <td>Libellé</td>
                                <td>Description</td>
                                <td>Etat</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>
    <!-- bottom bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(() => {
            Return_data();
            function Return_data() {
                let dmd_pret = '';
                let order = $("#Order").val();
                let fil_order = $("#Filter").val();
                let search_text = $("#Input__search").val();                
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_access.php',
                    data: {search: 'search',dmd_pret:dmd_pret,search_text:search_text,order:order,fil_order:fil_order},
                    success:  (Response) => {
                        // alert(Response);
                        $("tbody").html(Response);                    
                        $(".Count__fetch").html(Response);                    
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