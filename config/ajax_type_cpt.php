<?php
    session_start();
    error_reporting(1);
    if ($_SESSION['Autoriser'] != "oui") {
        header('Location: ../index.php');
    } 
    else {
        include '../config/bd_cnx.php';
        $IdRecup = $_SESSION['ID'];
        if (isset($_POST['action'])) {
            if (!empty($_POST['search_txt'])) {
                $query = "SELECT * FROM operation,compte WHERE compte.IDCPTE = operation.IDCPTE AND compte.IDCLT = ? AND compte.TYPE = ? AND operation.DATEOP LIKE '%" . $_POST['search_txt'] . "%'";
            }
            else {
                $query = "SELECT * FROM operation,compte WHERE compte.IDCPTE = operation.IDCPTE AND compte.IDCLT = ? AND compte.TYPE = ? ";
            }
            $state = $database->prepare($query);
            $state->execute(array($IdRecup,"Epargne"));
            $Row = $state->rowCount();
            if ($Row > 0) {
                while ($Data = $state->fetch()) {
                ?>
                    <tr id="Return">                  
                        <td><?php echo $Data['DATEOP']; ?></td>
                        <td><?php echo $Data['LIBELLEOP']; ?></td>
                        <td><?php echo $Data['MONTANTOP']; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h4 class="Not__found"> Aucune opération trouvée !</h4>
                <?php
            }
        }
        else if (isset($_POST['action2'])) {
            if (!empty($_POST['search_txt'])) {
                $query = "SELECT * FROM operation,compte WHERE compte.IDCPTE = operation.IDCPTE AND compte.IDCLT = ? AND compte.TYPE = ? AND operation.DATEOP LIKE '%" . $_POST['search_txt'] . "%'";
            }
            else {
                $query = "SELECT * FROM operation,compte WHERE compte.IDCPTE = operation.IDCPTE AND compte.IDCLT = ? AND compte.TYPE = ? ";
            }
            $state = $database->prepare($query);
            $state->execute(array($IdRecup,"Tontine"));
            $Row = $state->rowCount();
            if ($Row > 0) {
                while ($Data = $state->fetch()) {
                ?>
                    <tr id="Return">                  
                        <td><?php echo $Data['DATEOP']; ?></td>
                        <td><?php echo $Data['LIBELLEOP']; ?></td>
                        <td><?php echo $Data['MONTANTOP']; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h4 class="Not__found"> Aucune opération trouvée !</h4>
                <?php
            }
        }
        else if (isset($_POST['action3'])) {
            if (!empty($_POST['search_txt'])) {
                $query = "SELECT * FROM operation,compte WHERE compte.IDCPTE = operation.IDCPTE AND compte.IDCLT = ? AND compte.TYPE = ? AND operation.DATEOP LIKE '%" . $_POST['search_txt'] . "%'";
            }
            else {
                $query = "SELECT * FROM operation,compte WHERE compte.IDCPTE = operation.IDCPTE AND compte.IDCLT = ? AND compte.TYPE = ? ";
            }
            $state = $database->prepare($query);
            $state->execute(array($IdRecup,"Annuel"));
            $Row = $state->rowCount();
            if ($Row > 0) {
                while ($Data = $state->fetch()) {
                ?>
                    <tr id="Return">                  
                        <td><?php echo $Data['DATEOP']; ?></td>
                        <td><?php echo $Data['LIBELLEOP']; ?></td>
                        <td><?php echo $Data['MONTANTOP']; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h4 class="Not__found"> Aucune opération trouvée !</h4>
                <?php
            }
        }
       
    }
?>