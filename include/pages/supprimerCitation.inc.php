<h1>Supprimer citation</h1>
<?php
use \Classes\UTI\CitationManager;
use \Classes\UTI\PersManager;
use \Classes\UTI\VoteManager;

$citationManager = new CitationManager();
$voteManager = new VoteManager();
$persManager = new PersManager();


$cit_num = $_GET['cit_num'];
if (!empty($cit_num)){
    $voteManager->supprimerNote($cit_num);
    $citationManager->supprimerCitation($cit_num);
}

$citations = $citationManager->getAllCitations();

if ($citations){
    ?>
    <table>
        <tr>
            <th>Nom de l'enseignant</th>
            <th>Libellé</th>
            <th>Date</th>
            <th>Moyenne des notes</th>
            <th>Supprimer</th>
        </tr>
    <?php
    foreach ($citations as $citation) {

        $per_nom = $persManager->getPers($citation->per_num);
        $moyenne = $voteManager->getMoyenneCitation($citation->cit_num);


        ?>
        <tr>
            <td><?= $per_nom->per_nom ?></td>
            <td><?= $citation->cit_libelle ?></td>
            <td><?= $citation->cit_date ?></td>
            <td><?= $moyenne->moyenne ?></td>
            <td><img src="image/erreur.png" alt="erreur"
                         onclick="supprCitation(<?= $citation->cit_num ?>)"
                         onmouseover="style.cursor = 'pointer';"></td>
        </tr>

    <?php
    }
    ?>
    </table>
<?php
} else {
?>
    <em id="messageErreur">Il n'y a aucune citation à supprimer</em>
<?php
}