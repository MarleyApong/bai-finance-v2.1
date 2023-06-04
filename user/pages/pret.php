<?php
    session_start();
    if ($_SESSION['Autoriser']!= "oui") {
        header('Location: ../../index.php');
    }else {
        $IdC = $_SESSION['ID'];

        include "../../config/bd_cnx.php";
        // echo($NomUser);
        $sql = $database->prepare("SELECT * FROM `client` WHERE IDCLT = ?");
        $sql->execute(array($IdC));
        $data = $sql->fetch();
        $NomUser = $data['NOM'];
        $Avatar = $data['PROFIL'];

        if (isset($_POST['submit'])) {
            $Mont_p = htmlspecialchars($_POST['Mont_p']);
            $Motif_p = htmlspecialchars(ucfirst($_POST['Motif_p']));
            $Date_p = htmlspecialchars($_POST['Date_p']);
            $Dater_p = htmlspecialchars($_POST['Dater_p']);
            $Elem_g = htmlspecialchars($_POST['Elem_g']);
            $Desc = htmlspecialchars(ucfirst($_POST['Desc']));

            $Pret = $database->prepare("INSERT INTO pret (IDPRET,IDCLT,MONTANTPRET,MOTIF,DATEPRET,DATEREM,LIBELLE,DESCRIPTION,ETAT) VALUES (null, ?, ?, ?, ?, ?, ?, ?,?)");
            $Pret->execute(array($IdC,$Mont_p,$Motif_p,$Date_p,$Dater_p,$Elem_g,$Desc,'Non traite'));
            if ($Pret) {
                echo "
                    <script>alert('Demande de prêt envoyée avec succes !')</script>
                ";
                header('location: pret.php');
            }
        }
    }
   
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        $Title = "Prêt";
        require_once '../include/head.php';
    ?>
    <link rel="stylesheet" href="../../style/pret.css">
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

            <div class="Form__container content__padding">
                <div class="Form">
                    <div class="Form__header">
                        <div class="Title">
                            <h3>Demande de Prêt</h3>
                        </div>
                    </div>

                    <form class="Add__scrollY" action="" method="POST">
                        <div class="Info_Even">

                            <div class="Info_Even__header">
                                <div class="Important">
                                    <span></span>
                                    <h4> NB : Les champs obligatoires apparaissent en <span class="Red">rouge</span>.
                                    </h4>
                                </div>
                            </div>

                            <div class="Info_Even__content">
                                <div class="Name__group">
                                    <h3>Remplissez le formulaire</h3>
                                </div>

                                <div class="All_info_Even">
                                    <div class="Input__box">
                                        <label for="Mont_p">Montant : </label>
                                        <input type="number" id="Mont_p" name="Mont_p" />
                                        <small class="Message_err"></small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Motif_p">Motif : </label>
                                        <input type="text" id="Motif_p" name="Motif_p" />
                                        <small class="Message_err"></small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Date_p">Date du prêt : </label>
                                        <input type="date" id="Date_p" name="Date_p" />
                                        <small class="Message_err"></small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Dater_p">Date du rembourssement : </label>
                                        <input type="date" id="Dater_p" name="Dater_p" />
                                        <small class="Message_err"></small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Elem_g">Element de garantie : </label>
                                        <select name="Elem_g" id="Elem_g">
                                        <option value="">--</option>
                                            <?php
                                                $Checkclt = $database->prepare("SELECT LIBELLE FROM element_pret");
                                                $Checkclt->execute(array($IdC));
                                                while ($Chec = $Checkclt->fetch()) {
                                                    echo '<option value="'.$Chec['LIBELLE'].'">'.$Chec['LIBELLE'].'</option>';
                                                }
                                            ?>
                                            <option value="Autres">Autres</option>
                                        </select>
                                        <small class="Message_err"></small>
                                    </div>
                                    <div class="Input__box">
                                        <label for="Desc">Décrivez l'élément : </label>
                                        <textarea name="Desc" id="Desc" cols="30" rows="10"></textarea>
                                        <small class="Message_err"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Login__button">
                            <button name="submit">
                                <i class="fa-brands fa-telegram"></i>
                                <span>Envoyer la demande</span>
                            </button>
                            <a href="solde.php">
                                <i class="fa-solid fa-line-chart"></i>
                                <span>Solde</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- bottom_bar -->
    <?php
        require_once '../include/bottom_bar.php';
    ?>

    <script src="../../js/script.js"></script>
    <!-- <script src="../../js/jquery-3.6.1.js"></script> -->
    <script>
        // Initialisation de tous les champs du formulaire
        let Form = document.querySelector("form");
        let Mont_p = document.querySelector("#Mont_p");
        let Motif_p = document.querySelector("#Motif_p");
        let Date_p = document.querySelector("#Date_p");
        let Dater_p = document.querySelector("#Dater_p");
        let Elem_g = document.querySelector("#Elem_g");
        let Desc = document.querySelector("#Desc");

        Form.addEventListener('submit', e => {
            if (Mont_p.value == "") {
                Message = "Entrer la somme du prêt !";
                M_Error(Mont_p, Message);
                e.preventDefault();
            }else if (!Mont_p.value.match(/^[0-9]/)) {
                Message = "Valeur numérique attendue !";
                M_Error(Mont_p, Message);
                e.preventDefault();
            }
            if (Motif_p.value == "") {
                Message = "Entrez le motif du prêt !";
                M_Error(Motif_p, Message);
                e.preventDefault();
            }
            if (!Date_p.value.match(/^[0-9]/)) {
                Message = "Entrez la date de possession du prêt !";
                M_Error(Date_p, Message);
                e.preventDefault();
            }
            if (!Dater_p.value.match(/^[0-9]/)) {
                Message = "Entrez la date de rembourssement du prêt !";
                M_Error(Dater_p, Message);
                e.preventDefault();
            }
            if (Elem_g.value == "") {
                Message = "Choisissez l'élément de garantie !";
                M_Error(Elem_g, Message);
                e.preventDefault();
            }
            else if (Elem_g.value == "Autres" && Desc.value =="") {
                Message = "Entrez l'élément dans le mini formulaire !";
                M_Error(Desc, Message);
                e.preventDefault();
            }
        })

        // =============Fonction qui sera retournee en cas d'erreur

        function M_Error(champ, Message) {
            let Input_Box = champ.parentElement;
            let Small = Input_Box.querySelector('small');

            // Retour du message d'erreur 
            Small.innerText = Message;

            // Retour de la couleur selon l'erreur
            Input_Box.className = "Input__box Error";
        }

    </script>
</body>

</html>