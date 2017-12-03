<h1>Supprimer des personnes enregistrées</h1>
<?php
use Classes\UTI\EtudiantManager;
use Classes\UTI\SalarieManager;
use Classes\UTI\PersManager;
use \Classes\UTI\CitationManager;
use \Classes\UTI\VoteManager;

$citationManager = new CitationManager();
$voteManager = new VoteManager();
$persManager = new PersManager();
$managerEtu = new EtudiantManager();
$salManager = new SalarieManager();



$per_num = $_GET['per_num'];
if (!empty($per_num)){
    $citations = $citationManager->getCitationsByEtudiant($per_num);
    foreach ($citations as $citation){
        $voteManager->supprimerNote($citation->cit_num);
    }
    $voteManager->supprimerNoteByPers($per_num);
    $citationManager->supprimerCitationByEtu($per_num);


    $existEtu = $managerEtu->getEtudiant($per_num);
    if ($existEtu){
        $managerEtu->supprimerEtudiant($per_num);
    } else {
        $salManager->supprimerSal($per_num);
    }
    $persManager->supprimerPersonne($per_num);
}

$personnes = $managerEtu->getAllPers();

if ($personnes) {
    ?>

    <table id="listPers">

        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
        <?php

        foreach ($personnes as $pers) {
            ?>
            <tr>
                <td><?php echo $pers->per_nom ?></td>
                <td><?php echo $pers->per_prenom ?></td>
                <td><img src="image/erreur.png" alt="erreur"
                         onclick="supprPersonne(<?= $pers->per_num ?>)"
                         onmouseover="style.cursor = 'pointer';"></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <?php
} else {
?>
    <em id="messageErreur">Il n'y a aucune personne à supprimer</em>
<?php
}
?>
