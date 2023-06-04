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
    <link rel="stylesheet" href="../style/liste_transaction.css">
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
            <?php
                require_once '../../include/modal_operation.php';
           ?>
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
                let list_oper_ad = '';
                let order = $("#Order").val();
                let fil_order = $("#Filter").val();
                let search_text = $("#Input__search").val();                
                $.ajax ({
                    type: 'POST',
                    url: '../../config/ajax_access.php',
                    data: {search: 'search',list_oper_ad:list_oper_ad,search_text:search_text,order:order,fil_order:fil_order},
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