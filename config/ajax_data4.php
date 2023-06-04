<?php 
session_start();
    include 'bd_cnx.php';
    $id = $_SESSION['IDEMP'];
    $_SESSION['Error'] = '';
    @$_SESSION['Success_prof'] = '';
    @$_SESSION['Success_info'] = '';
    @$_SESSION['Success_pass'] = '';
    $Profession = htmlspecialchars(ucfirst(strtolower($_POST['Profession'])));
    $Pays = htmlspecialchars(ucfirst(strtolower($_POST['Pays'])));
    $Ville = htmlspecialchars(ucfirst(strtolower($_POST['Ville'])));
    $Qtier = htmlspecialchars(ucfirst(strtolower($_POST['Qtier'])));
    $Phone = htmlspecialchars($_POST['Phone']);
    $Email = htmlspecialchars($_POST['Email']);
    if(isset($_POST['Profession'])) {
        $sql = $database->query("UPDATE employe SET PROFESSION = '$Profession' WHERE IDEMP = '$id'");  
        // $_SESSION['Success_prof'] = 'Profil modifié avec succes !';   
        echo "<script>
            alert('ok')
        </script>";
    }
    if (isset($_POST['Pays']) || isset($_POST['Ville']) || isset($_POST['Qtier']) || isset($_POST['Phone']) || isset($_POST['Email'])) {
        $sql = $database->query("UPDATE employe SET VILLE = '$Ville', QUARTIER = '$Qtier', TEL = '$Phone', EMAIL = '$Email' WHERE IDEMP = '$id'");
        header('location : ..super_admin/pages/parametre.php?Success_info = Information modifiée avec succes !'); 
    }
    if (isset($_POST['Last_pass']) || isset($_POST['New_Pass']) || isset($_POST['Config_pass'])) {
        $sql = $database->prepare("SELECT * FROM `employe` WHERE IDEMP = ?");
        $sql->execute(array($id));
        $data = $sql->fetch();
        if (password_verify($_POST['Last_pass'],$data['PASS'] )) {
            if ($_POST['New_Pass'] == $_POST['Config_pass']) {
                $New_pass = $_POST['New_Pass'];
                $cost = ['cost' => 12];
                $Hash_pass = password_hash("$New_pass", PASSWORD_BCRYPT, $cost);
                $sql = $database->query("UPDATE employe SET PASS = '$Hash_pass' WHERE IDEMP = '$id'");
                // $_SESSION['Success_pass'] = 'Information modifiée avec succes !';   
            }
            else {
                // $_SESSION['Success_pass'] = 'Les mots de passe sont différents !';   
            }
        }
        else {
            // $_SESSION['Success_pass'] = 'Mot de passe incorrect !';   
        }
    }
