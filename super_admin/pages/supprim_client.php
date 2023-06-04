<?php
session_start();
if ($_SESSION['Autoriser'] != "oui") {
    header('Location: ../../index.php');
} else {
    $IDAD = $_SESSION['IDEMP'];

    include_once "../../config/bd_cnx.php";

    // Recuperation de l'id dans le lien
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
