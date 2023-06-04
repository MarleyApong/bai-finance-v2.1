<?php
    // Authentification
    require_once '../include/authentification.php';
    $IDCLT = $_GET['id'];
    $statement = $database->prepare("UPDATE pret SET ETAT = ? WHERE IDCLT = ? ");
    $statement->execute(array('Refusée',$IDCLT));

    if ($statement) {
        header('location: demande_pret.php');
    }
?>