<?php
    session_start();
    error_reporting(0);
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../index.php');
    }else {
        $IdC = $_SESSION['ID'];

        include "../../config/bd_cnx.php";
        $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $sql->execute(array($IdC));
        $data = $sql->fetch();
        $NomUser = $data['NOM'];
        $Avatar = $data['PROFIL'];
        
    }
?>