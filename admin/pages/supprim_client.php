<?php
    session_start();
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../../index.php');
    }else {
        $IDAG = $_SESSION['IDAG'];

        include_once "../../config/bd_cnx.php";
        $id = $_GET['id'];

        // Requete de suppresion
        $req = $database->prepare("DELETE FROM client WHERE IDCLT = ?");
        $req->execute(array($id));
        $req2 = $database->prepare("DELETE FROM compte WHERE IDCLT = ?");
        $req2->execute(array($id));
        if($req->execute(array($id)) && $req2->execute(array($id))) {
            // Redirection
            header("Location: liste_client.php");
        }
    }
?>

