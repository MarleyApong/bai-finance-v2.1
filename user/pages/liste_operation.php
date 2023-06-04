<!-- authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Liste des opérations";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/liste_operation.css">
    <link rel="stylesheet" href="../../style/box.css">
    <link rel="stylesheet" href="../../style/formHeader.css">
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
                    <h3>Liste des opérations</h3>
                </div>
            </div>

             <!-- modal operation -->
             <div class="Contact">
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
                <option value="IDOP">Id opération</option>
                <option value="IDCPTE">Id compte</option>
                <option value="LIBELLEOP">Type d'opération</option>
                <option value="MONTANTOP">Montant</option>
                <option value="DATEOP">Date transaction</option>
            </select>
        </div>
        <div class="Control__display">
            <input type="text" id="Input__search" name="Input__search" placeholder="rechercher">
        </div>
        <div class="Control__display Count__fetch">

        </div>
    </div>

    <div class="RecentOrders">
        <table>
            <thead>
                <tr>
                    <td>Id opération</td>
                    <td>Id compte</td>
                    <td>Type d'opération</td>
                    <td>Montant</td>
                    <td>Date transaction</td>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>
</div>
        </div>
    </div>
    <!-- bottom_bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/box_call.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(() => {
            Return_data();
            function Return_data() {
                let list_oper_cl = '';
                let order = $("#Order").val();
                let fil_order = $("#Filter").val();
                let search_text = $("#Input__search").val();                
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_access.php',
                    data: {search: 'search',list_oper_cl:list_oper_cl,search_text:search_text,order:order,fil_order:fil_order},
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