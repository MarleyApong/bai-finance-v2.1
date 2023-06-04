<!-- authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = 'Détails comptes';
        require_once '../include/head.php';
    ?>

    <link rel="stylesheet" href="../styles/details_compte.css">
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
                            <option value="NOM">nom</option>
                            <option value="PRENOM">prenom</option>
                            <option value="DATECREAT">date d'arrivée</option>
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
                                <td>Nom</td>
                                <td>prénom</td>
                                <td>Age</td>
                                <td>Solde Epargne</td>
                                <td>Solde Tontine</td>
                                <td>Solde Annuel</td>
                                <td>Date arrivée</td>
                                <!-- <td>Plus</td> -->
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!-- nav_bottom -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../../js/script.js"></script>
    <script src="../../../js/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(() => {
            Return_data();

            function Return_data() {
                let details_cpt = '';
                let order = $("#Order").val();
                let fil_order = $("#Filter").val();
                let search_text = $("#Input__search").val();
                $.ajax({
                    type: 'POST',
                    url: '../../config/ajax_data_agent.php',
                    data: {
                        search: 'search',
                        details_cpt: details_cpt,
                        search_text: search_text,
                        order: order,
                        fil_order: fil_order
                    },
                    success: (Response) => {
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