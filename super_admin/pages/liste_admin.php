<!-- Authentification -->
<?php
    require_once '../include/authentification.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Liste admin";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../style/liste_admin.css">
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

            <!-- middle -->
            <?php
                include_once '../include/middle.php';
            ?>

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
                            <option value="Tous">tous</option>
                            <option value="Admin">Admin</option>
                            <option value="Agent">Agent</option>
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
                    <table id="employes">
                        <thead>
                            <tr>
                                <td>Profil</td>
                                <td>Id</td>
                                <td>Nom</td>
                                <td>prénom</td>
                                <td>Age</td>
                                <td>Sexe</td>
                                <td>Quartier</td>
                                <td>Téléphone</td>
                                <td>Etat</td>
                                <td>Modif</td>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- bottom bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <script src="../../js/search.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script>
        $(document).ready(() => {
            Return_data();
            function Return_data() {
                let liste_admin = '';
                let order = $("#Order").val();
                let fil_order = $("#Filter").val();
                let search_text = $("#Input__search").val();                
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_data_agent.php',
                    data: {search: 'search',liste_admin:liste_admin,search_text:search_text,order:order,fil_order:fil_order},
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
                // alert(order)
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