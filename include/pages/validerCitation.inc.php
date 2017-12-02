<h1>Valider une citation</h1>


<?php
use \Classes\UTI\PersManager;
use \Classes\UTI\CitationManager;
use \Classes\UTI\VoteManager;

$persManager = new PersManager();
$citationManager = new CitationManager();
$voteManager = new VoteManager();

$citations = $citationManager->getCitationAValider();

$cit_num = $_GET['cit_num'];
if (!empty($cit_num)){
    if ($_GET['valid'] == 0){
        $citationManager->validerCitation($cit_num, date('Y-m-d'));
    } else {
        $citationManager->supprimerCitation($cit_num);
    }
}

if (!empty($citations)) {

    foreach ($citations as $citation) {
        $per_nom = $persManager->getPers($citation->per_num);

        ?>
        <table>
            <tr>
                <th>Nom de l'enseignant</th>
                <th>Libellé</th>
                <th>Date</th>
                <th>Validation</th>
                <th>Invalider</th>
            </tr>
            <tr>
                <td><?= $per_nom->per_nom ?></td>
                <td><?= $citation->cit_libelle ?></td>
                <td><?= $citation->cit_date ?></td>
                <td><img src="image/valid.png" alt="valider" onclick="valider(<?= $citation->cit_num
                    ?>)" onmouseover="style.cursor = 'pointer';"></td>
                <td><img src="image/erreur.png" alt="invalider" onclick="invalider(<?= $citation->cit_num
                    ?>)" onmouseover="style.cursor = 'pointer';"></td>
            </tr>
        </table>
        <?php
    }
} else {
?>
    <em id="messageErreur">Il n'y a aucune citation à valider</em>
<?php
}

?>
