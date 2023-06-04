<?php 
session_start();
error_reporting(0);
if ($_SESSION['Autoriser']!= "oui") {
    header('Location: ../../../index.php');
}
    include 'bd_cnx.php';

    $Idc = $_SESSION['ID'];

    $Profession = htmlspecialchars(ucfirst(strtolower($_POST['Profession'])));
    $Ville = htmlspecialchars(ucfirst(strtolower($_POST['Ville'])));
    $Qtier = htmlspecialchars(ucfirst(strtolower($_POST['Qtier'])));
    $Phone = htmlspecialchars($_POST['Phone']);
    $Email = htmlspecialchars($_POST['Email']);
    if(isset($_POST['Profession'])) {
        $sql = $database->prepare("UPDATE client SET PROFESSION = ? WHERE IDCLT = ?");  
        $sql->execute(array($Profession,$Idc));
        if ($sql) {
            echo "PROFESSION MODIFIEE AVEC SUCCES !";
        }
    }
    if (isset($_POST['Ville']) || isset($_POST['Qtier']) || isset($_POST['Phone']) || isset($_POST['Email'])) {
        $sql = $database->prepare("UPDATE client SET VILLE = ?, QUARTIER = ?, TEL = ?, EMAIL = ? WHERE IDCLT = ?");
        $sql->execute(array($Ville,$Qtier,$Phone,$Email,$Idc));
        if ($sql) {
            echo "INFORMATION(S) MODIFIEE AVEC SUCCES !";
        }
    }
    if (isset($_POST['Last_pass']) || isset($_POST['New_Pass']) || isset($_POST['Config_pass'])) {
        $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $sql->execute(array($Idc));
        $data = $sql->fetch();
        $cost = ['cost' => 12];
        if (password_verify($_POST['Last_pass'],$data['PASS'])) {
            if ($_POST['New_Pass'] == $_POST['Config_pass']) {
                if (strlen($_POST['New_Pass']) > 4) {
                    $New_pass = $_POST['New_Pass'];
                    $Hash_pass = password_hash("$New_pass", PASSWORD_BCRYPT, $cost);
                    $sql = $database->prepare("UPDATE client SET PASS = ? WHERE IDCLT = ?");
                    $sql->execute(array($Hash_pass,$Idc));
                    if ($sql) {
                        echo "MOT DE PASSE MODIFIE AVEC SUCCES !";
                    }
                }
                else {
                    echo "LE MOT DE PASSE DOIT ETRE SUPERIEUR A  4  CARACTERES !";
                }            
            }
            else {
                echo "LES MOTS DE PASSE SONT DIFFERENTS !\n";
                echo "RESSAYEZ !\n";
            }
        }
        else {
            echo "MOT DE PASSE INCORRECT !\n";       
        }
    }
