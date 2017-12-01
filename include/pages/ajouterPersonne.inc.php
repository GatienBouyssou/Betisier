<h1>Ajouter une personne</h1>
<?php
use \Classes\UTI\PersManager;
use \Classes\UTI\ConnexionManager;
use \Classes\UTI\DepManager;
use \Classes\UTI\DivisionManager;
use \Classes\UTI\FonctionManager;
use \Classes\UTI\SalarieManager;
use \Classes\UTI\EtudiantManager;

$patternTel = " pattern=\"[0-9]{10}\"";

if (empty($_POST['fonction']) && empty($_POST['division']) && empty($_POST['etat']) ) {
    ?>
    <form id="formConnect" action="index.php?page=1" method="post">
        <label class="labelGauche">Nom :</label>
        <input class="boxDroite" type="text" name="nom" required>
        <br>
        <label class="labelGauche">Prénom :</label>
        <input class="boxDroite" type="text" name="prenom" required>
        <br>
        <label class="labelGauche">Téléphone :</label>
        <input class="boxDroite" type="tel" <?= $patternTel ?> name="telephone" required>
        <br>
        <label class="labelGauche">Mail :</label>
        <input class="boxDroite" type="email" name="email" required>
        <br>
        <label class="labelGauche">Login :</label>
        <input class="boxDroite" type="text" name="login" required>
        <br>
        <label class="labelGauche">Mot de passe :</label>
        <input class="boxDroite" type="password" name="mdp" required>
        <br>
        <label class="labelGauche">Categorie :</label>
        <label class="boxDroite">
            Etudiant<input type="radio" checked="checked" name="etat" value="etudiant">
            Salarié <input type="radio" name="etat" value="salarie">
        </label>

        <input class="boxDroite" type="submit" value="Valider">
    </form>
<?php
} elseif (!empty($_POST['etat']) && empty($_POST['fonction']) && empty($_POST['division'])) {

    $managerPers = new PersManager();
    $connexionManager = new ConnexionManager($managerPers);
    $_POST['mdp'] = $connexionManager->tradMdp($_POST['mdp']);
    $managerPers->addPersonne($_POST);
    $per_num = $managerPers->getPersByLogin($_POST['login']);
    $_SESSION['per_num'] = $per_num->per_num;

    if ($_POST['etat'] === 'etudiant'){
        $depManager = new DepManager();
        $divManager = new DivisionManager();

        $divisions = $divManager->getAllDivision();
        $departements = $depManager->getAllDepartements();

?>
        <form id="formConnectEtudiant" action="index.php?page=1" method="post">
            <label class="labelGauche">Année :</label>
            <select class="boxDroite" name="division">
                <?php
                foreach ($divisions as $division){
                    ?>
                    <option value=<?='"'.$division->div_num.'"'?>><?='"'.$division->div_nom.'"'?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <label class="labelGauche">Département :</label>
            <select class="boxDroite" name="departement">
                <?php
                foreach ($departements as $departement){
                ?>
                    <option value=<?='"'.$departement->dep_num.'"'?>><?='"'.$departement->dep_nom.'"'?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <input class="boxDroite" type="submit" value="Valider">
        </form>
<?php
    } else {

        $fonctionManager = new FonctionManager();
        $fonctions = $fonctionManager->getAllFonctions();

?>
        <form id="formConnectSalarie" action="index.php?page=1" method="post">
            <label class="labelGauche">Téléphone professionnel :</label>
            <input class="boxDroite" type="tel" <?= $patternTel ?> name="telephone" required>
            <br>
            <label class="labelGauche">Fonction :</label>
            <select class="boxDroite" name="fonction">
                <?php
                foreach ($fonctions as $fonction){
                    ?>
                    <option value=<?='"'.$fonction->fon_num.'"'?>><?='"'.$fonction->fon_libelle.'"'?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <input class="boxDroite" type="submit" value="Valider">
        </form>
<?php
    }
} else {


    if (!empty($_POST['departement'])){
        $etudiantManager = new EtudiantManager();
        $etudiantManager->addEtudiant([$_SESSION['per_num'], $_POST['departement'], $_POST['division']]);
    } else {
        $salarieManager = new SalarieManager();
        $salarieManager->addSalarie([$_SESSION['per_num'],$_POST['telephone'], $_POST['fonction']]);
    }
?>
    <p>Votre personne a été ajouté avec succès</p>
    <script>redirectionAccueil()</script>

    <?php
}
?>