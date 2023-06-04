<?php
    session_start();
    error_reporting(0);
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../index.php');
    }else {
        $IDAD = $_SESSION['IDEMP'];

        include "../../config/bd_cnx.php";
        $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
        $sql->execute(array($IDAD));
        $data = $sql->fetch();
        $NomUser = $data['NOMEMP'];
        $Avatar = $data['PROFIL'];
    }
?>