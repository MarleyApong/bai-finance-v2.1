<?php
session_start();
// connexion bd
require 'bd_cnx.php';
$IdC = $_SESSION['ID'];

$Checkclt = $database->query("SELECT NOMTYPE FROM type_compte ORDER BY IDTY_CPTE");
$Idty = array();
$Nomtty = array();

while ($Check = $Checkclt->fetch()) {
    $ty[] = $Check['NOMTYPE'];
}
$ep = $ty[0];
$tn = $ty[1];
$an = $ty[2];

$Ch = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ?");
$Ch2 = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ?");
$Ch3 = $database->prepare("SELECT SOLDE FROM compte WHERE TYPE = ? and IDCLT = ?");
$Ch->execute(array($ep, $IdC));
$Ch2->execute(array($tn, $IdC));
$Ch3->execute(array($an, $IdC));
$Solde_epargne = $Ch->fetch();
$Solde_tontine = $Ch2->fetch();
$Solde_annuel = $Ch3->fetch();

?>
<div class="Box">
    <div class="Box__icon">
        <i class="fa-solid fa-leaf"></i>
    </div>
    <div class="Box__description">
        <p>Solde Epargne</p>
        <button class="Box__link"><?= $Solde_epargne['SOLDE'] ?> fcfa</button>
        <p>

        </p>
    </div>
</div>

<div class="Box">
    <div class="Box__icon">
        <i class="fa-solid fa-handshake"></i>
    </div>
    <div class="Box__description">
        <p>Solde Tontine</p>
        <button class="Box__link"><?= $Solde_tontine['SOLDE'] ?> fcfa</button>
        <p></p>
    </div>
</div>

<div class="Box">
    <div class="Box__icon">
        <i class="fa-solid fa-hourglass-2"></i>
    </div>
    <div class="Box__description">
        <p>Solde Annuel</p>
        <button class="Box__link"><?= $Solde_annuel['SOLDE'] ?> fcfa</button>
        <p></p>
    </div>
</div>
<?php
?>