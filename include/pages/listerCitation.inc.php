<h1>Liste des citations déposées</h1>
<table id="listCit">
<?php
    use \Classes\UTI\PersManager;
    use \Classes\UTI\CitationManager;
    use \Classes\UTI\VoteManager;

    $persManager = new PersManager();
    $citationManager = new CitationManager();
    $voteManager = new VoteManager();
    $citations = $citationManager->getTop2Citation();
?>
<tr>
    <th>Nom de l'enseignant</th>
    <th>Libellé</th>
    <th>Date</th>
    <th>Moyenne des notes</th>
</tr>
<?php
    foreach ($citations as $citation){
        $per_nom = $persManager->getPers($citation->per_num);
        $nbrCitations = $citationManager->getNumberCitation();
?>
        <tr>
            <td><?= $per_nom->per_nom ?></td>
            <td><?= $citation->cit_libelle?></td>
            <td><?= $citation->cit_date ?></td>
            <td><?= $citation->moyenne ?></td>
        </tr>
<?php
    }
?>

</table>

<p>Le nombre de citation est : <?= $nbrCitations->nbrCitations ?></p>