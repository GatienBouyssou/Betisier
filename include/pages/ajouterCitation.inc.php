<h1>Ajouter une citation</h1>
<?php
use \Classes\UTI\CitationManager;
use \Classes\UTI\PersManager;
use \Classes\UTI\MotManager;

$personneManager = new PersManager();
$citationManager = new CitationManager();
$motManager = new MotManager();

$postCitation = $_POST['citation'];
$cit_date = $_POST['cit_date'];
$fonction = $_POST['fonction'];

if (isset($postCitation)){
    $motsInterdits = $motManager->getAllMots();
    $motsInvalide = [];
    foreach ($motsInterdits as $motInterdit){
        $mot_interdit = $motInterdit->mot_interdit;
        if (strpos(strtolower($postCitation), $mot_interdit)){
            $postCitation = preg_replace("#$mot_interdit#i",'---',$postCitation);
            $motsInvalide[] = $mot_interdit;
        }
    }
}
$enseignants = $personneManager->getAllEnseignants();


if (empty($fonction) || $_POST['citation'] !== $postCitation) {
?>
    <form id="formAjoutCitation" action="index.php?page=5" method="post">
        <label class="labelGauche">Enseignant :</label>

        <select class="boxDroite" name="fonction">
            <?php
            foreach ($enseignants as $enseignant) {
                $nomEnseignant = $enseignant->per_nom;
                $numEnseignant = $enseignant->per_num;

                if ($numEnseignant !== $fonction) {
            ?>
                    <option value=<?= $numEnseignant ?>><?= $nomEnseignant ?></option>
                <?php
                }else{
                ?>
                    <option selected="selected" value=<?= $numEnseignant ?>><?=  $nomEnseignant  ?></option>
            <?php
                }
            }
            ?>
        </select>
        <br>
        <label class="labelGauche">Date Citation</label>
        <input class="boxDroite" type="date" name="cit_date" value=<?= '"'. $cit_date .'"' ?> required>
        <br>
        <label class="labelGauche">Citation :</label>
        <?php if (isset($postCitation)) { ?>
            <textarea class="boxDroite" name="citation" rows="5" cols="50" required><?= $postCitation ?></textarea>
            <br>
        <?php
        }else {
        ?>
            <textarea class="boxDroite" name="citation" rows="5" cols="50" required></textarea>
            <br>
        <?php
        }
        if (!empty($motsInvalide)){
            foreach ($motsInvalide as $mot){
        ?>
                <div class="labelGauche">
                    <img src="image/erreur.png" alt="PhotoErreur">
                    le mot : <em id="messageErreur"><?= $mot ?></em> n'est pas autorisé <br>
                </div>
        <?php
            }
        }
        ?>


        <br>
        <input class="boxDroite" type="submit" value="Valider">
    </form>
<?php
} else {
    $per_num_etu = $personneManager->getPersByLogin($_SESSION['login']);
    $citationManager->addCitation([$fonction, $per_num_etu->per_num, $postCitation, $cit_date]);
?>
    <div class="labelGauche">
        <img src="image/valid.png" alt="PhotoErreur">
        Votre citation a bien été enregistré
    </div>
<?php
}
?>