<?php
session_start();
if ($_SESSION['Autoriser'] != "oui") {
    header('Location: ../../index.php');
} else {
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
    $Title = "Solde";
    require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/solde.css">
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

            <div class="Form__header">
                <div class="Title">
                    <h3>Soldes</h3>
                </div>
            </div>

            <div class="Content Content__padding">
                
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
            let solde = "";
            $.ajax({
                type: 'POST',
                url: '../../config/ajax_solde.php',
                data: {
                    solde: 'solde'
                },
                success: (Response) => {
                    $(".Content").html(Response);                   
                }
            })
        })
    </script>
</body>

</html>