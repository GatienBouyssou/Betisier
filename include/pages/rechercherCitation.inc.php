<h1>Rechercher une Citation</h1>

<form id="formRechercheCitation" action="index.php?page=11" method="post">
    <label class="labelGauche">Recherche :</label>
    <input class="boxDroite" type="text" name="recherche" >
    <br>
    <br>
    <br>
    <input  type="submit" >
    <br>
</form>

<?php
use \Classes\UTI\PersManager;
use \Classes\UTI\CitationManager;
use \Classes\UTI\VoteManager;


$motRecherche = $_POST['recherche'];

if (!empty($motRecherche)){

    $persManager = new PersManager();
    $citationManager = new CitationManager();
    $voteManager = new VoteManager();


    $etuCourant = $persManager->getPersByLogin($_SESSION['login']);

    $dateSlash = strpos($motRecherche, '/');
    $dateTire = strpos($motRecherche, '-');

    if ($dateSlash || $dateTire){
        $resRecherche = $citationManager->getBydate($motRecherche);
    } elseif (is_numeric($motRecherche)){
        $resRecherche = $voteManager->getByNote($motRecherche);
    } else {
        $per_num_enseignant = $persManager->getEnseignantByNom($motRecherche);
        $resRecherche = [];
        foreach ($per_num_enseignant as $enseignant){
            $resRecherche = array_merge($resRecherche,$citationManager->getCitationsByPersonne($enseignant->per_num));
        }
    }
    if ($resRecherche){
        ?>
        <table>
            <tr>
                <th>Nom de l'enseignant</th>
                <th>Libellé</th>
                <th>Date</th>
                <th>Moyenne des notes</th>
                <th>Noter</th>
            </tr>
        <?php

        foreach ($resRecherche as $cit_num) {

            $citation = $citationManager->getCitation($cit_num->cit_num);
            $per_nom = $persManager->getPers($citation->per_num);
            $moyenne = $voteManager->getMoyenneCitation($cit_num->cit_num);
            $aVote = $voteManager->getVote($etuCourant->per_num, $cit_num->cit_num);


            ?>
            <tr>
                <td><?= $per_nom->per_nom ?></td>
                <td><?= $citation->cit_libelle ?></td>
                <td><?= $citation->cit_date ?></td>
                <td><?= $moyenne->moyenne ?></td>
                <?php if (empty($aVote->vot_valeur)) { ?>
                    <td><img src="image/modifier.png" alt="modifier" onclick="noter(<?= $cit_num->cit_num ?>)"
                             onmouseover="style.cursor = 'pointer';"></td>
                <?php } else { ?>
                    <td><img src="image/erreur.png" alt="erreur"
                             onclick="modifNote(<?= $aVote->vot_valeur . ', ' . $cit_num->cit_num ?>)"
                             onmouseover="style.cursor = 'pointer';"></td>
                <?php } ?>
            </tr>

            <?php
        }
        ?>
        </table>
        <?php
    } else {
    ?>
        <em id="messageErreur">Aucun resultat ne correspond à vos critères</em>
    <?php
    }
}
?>

