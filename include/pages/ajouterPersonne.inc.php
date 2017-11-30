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
        <label class="lbAjPers">Nom :</label>
        <input class="boxAjPers" type="text" name="nom" required>
        <br>
        <label class="lbAjPers">Prénom :</label>
        <input class="boxAjPers" type="text" name="prenom" required>
        <br>
        <label class="lbAjPers">Téléphone :</label>
        <input class="boxAjPers" type="tel" <?= $patternTel ?> name="telephone" required>
        <br>
        <label class="lbAjPers">Mail :</label>
        <input class="boxAjPers" type="email" name="email" required>
        <br>
        <label class="lbAjPers">Login :</label>
        <input class="boxAjPers" type="text" name="login" required>
        <br>
        <label class="lbAjPers">Mot de passe :</label>
        <input class="boxAjPers" type="password" name="mdp" required>
        <br>
        <label class="lbAjPers">Categorie :</label>
        <label class="boxAjPers">
            Etudiant<input type="radio" checked="checked" name="etat" value="etudiant">
            Salarié <input type="radio" name="etat" value="salarie">
        </label>

        <input class="boxAjPers" type="submit" value="Valider">
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
            <label class="lbAjPers">Année :</label>
            <select class="boxAjPers" name="division">
                <?php
                foreach ($divisions as $division){
                    ?>
                    <option value=<?='"'.$division->div_num.'"'?>><?='"'.$division->div_nom.'"'?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <label class="lbAjPers">Département :</label>
            <select class="boxAjPers" name="departement">
                <?php
                foreach ($departements as $departement){
                ?>
                    <option value=<?='"'.$departement->dep_num.'"'?>><?='"'.$departement->dep_nom.'"'?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <input class="boxAjPers" type="submit" value="Valider">
        </form>
<?php
    } else {

        $fonctionManager = new FonctionManager();
        $fonctions = $fonctionManager->getAllFonctions();

?>      <form id="formConnectSalarie" action="index.php?page=1" method="post">
            <label class="lbAjPers">Téléphone professionnel :</label>
            <input class="boxAjPers" type="tel" <?= $patternTel ?> name="telephone" required>
            <br>
            <label class="lbAjPers">Fonction :</label>
            <select class="boxAjPers" name="fonction">
                <?php
                foreach ($fonctions as $fonction){
                    ?>
                    <option value=<?='"'.$fonction->fon_num.'"'?>><?='"'.$fonction->fon_libelle.'"'?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <input class="boxAjPers" type="submit" value="Valider">
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