<h1>Liste des citations déposées</h1>

<?php
use \Classes\UTI\EtudiantManager;
use \Classes\UTI\CitationManager;
use \Classes\UTI\VoteManager;

$etuManager = new EtudiantManager();
$citationManager = new CitationManager();
$voteManager = new VoteManager();

$citations = $citationManager->getAllCitations();

$etuCourant = $etuManager->getPersByLogin($_SESSION['login']);
if ($citations) {

        $nbrCitations = $citationManager->getNumberCitation();
    $compteur = 0;

    $cit_num = $_GET['cit_num'];

    if (!empty($cit_num)) {
        $value = $_GET['value'];
        $voteManager->setVote($cit_num, $etuCourant->per_num, $value);

    }


    ?>

    <?php if (empty($_SESSION['login'])) { ?>
        <table id="listCit">
            <tr>
                <th>Nom de l'enseignant</th>
                <th>Libellé</th>
                <th>Date</th>
                <th>Moyenne des notes</th>
            </tr>
            <?php
            foreach ($citations as $citation) {
                $per_nom = $etuManager->getPers($citation->per_num);
                $moyenne = $voteManager->getMoyenneCitation($citation->cit_num);
                $compteur++;
                ?>
                <tr>
                    <td><?= $per_nom->per_nom ?></td>
                    <td><?= $citation->cit_libelle ?></td>
                    <td><?= $citation->cit_date ?></td>
                    <td><?= $moyenne->moyenne ?></td>
                </tr>
                <?php
            }
            ?>

        </table>


        <?php

    } else {
        ?>
        <table id="listCit">
            <tr>
                <th>Nom de l'enseignant</th>
                <th>Libellé</th>
                <th>Date</th>
                <th>Moyenne des notes</th>
                <th>Noter</th>
            </tr>
            <?php
            foreach ($citations as $citation) {
                $per_nom = $etuManager->getPers($citation->per_num);
                $moyenne = $voteManager->getMoyenneCitation($citation->cit_num);
                $aVote = $voteManager->getVote($etuCourant->per_num, $citation->cit_num);
                $compteur++;
                $etu_div = $etuManager->getEtudiant($etuCourant->per_num)
                ?>
                <tr>
                    <td><?= $per_nom->per_nom ?></td>
                    <td><?= $citation->cit_libelle ?></td>
                    <td><?= $citation->cit_date ?></td>
                    <td><?= $moyenne->moyenne ?></td>
                    <?php if (empty($aVote->vot_valeur) && $etu_div) { ?>
                        <td><img src="image/modifier.png" alt="modifier" onclick="noter(<?= $citation->cit_num ?>)"
                                 onmouseover="style.cursor = 'pointer';"></td>
                    <?php } else if ($etu_div) { ?>
                        <td><img src="image/erreur.png" alt="erreur"
                                 onclick="modifNote(<?= $aVote->vot_valeur . ', ' . $citation->cit_num ?>)"
                                 onmouseover="style.cursor = 'pointer';"></td>
                    <?php } ?>
                </tr>
                <?php
            }
            ?>

        </table>

        <?php
    }
    ?>

    <p>Le nombre de citations enregistrées est de : <?= $nbrCitations->nbrCitations ?>
        dont <?= $nbrCitations->nbrCitations - $compteur ?> en attente </p>
    <?php
} else {
?>
    <em id="messageErreur">Il n'y a aucune citation</em>
<?php
}
?>